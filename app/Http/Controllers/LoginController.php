<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\userpost;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Validator;

class LoginController extends Controller
{
    //This method will show login page for user
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'E-Mail ist erforderlich.',
            'email.email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'password.required' => 'Passwort ist erforderlich.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }
    
        $user = User::where('email', $req->email)->first();
    
        if (!$user) {
            return redirect()->route('account.login')
                ->withInput()
                ->with('error', 'Diese E-Mail-Adresse existiert nicht.');
        }
    
        if (!Hash::check($req->password, $user->password)) {
            return redirect()->route('account.login')
                ->withInput()
                ->with('error', 'Falsches Passwort.');
        }
    
        if ($user->accept_card == 0) {
            session(['temp_user_id' => $user->id]);
            return redirect()->route('student.upload.card');
        }
    
        if (is_null($user->email_verified_at)) {
            Mail::to($user->email)->send(new VerifyEmail($user));
            return view('auth.verify', ['email' => $user->email]);
        }
    
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
    
            if (Auth::user()->role != 'user') {
                Auth::logout();
                return redirect()->route('account.login')
                    ->with('error', 'Sie sind nicht berechtigt, auf diese Seite zuzugreifen.');
            }
    
            if (session()->has('module_type') && session()->has('module_id')) {
                $moduleType = session('module_type');
                $moduleId = session('module_id');
    
                session()->forget(['module_type', 'module_id']);
    
                return redirect()->route('account.enroll', [
                    'module_type' => $moduleType,
                    'module_id' => $moduleId,
                ]);
            }
    
            if (session()->has('post_cat_id')) {
                return redirect()->route('account.login');
            }
    
            if (session()->has('meett_cat_id')) {
                return redirect('meet/categry/' . session('meett_cat_id'));
            }
    
            if (session()->has('pending_comment')) {
                $comment = session()->get('pending_comment');
    
                $post = \App\Models\Post::find($comment['post_id']);
                $userPost = \App\Models\userpost::find($comment['post_id']);
    
                if ($post) {
                    return redirect()->route('forum.topic.web', ['id' => $post->slug]);
                } elseif ($userPost) {
                    return redirect()->route('forum.topic.web', ['id' => $userPost->slug]);
                }
            }
    
            return redirect()->route('account.dashboard');
        }
    
        return redirect()->route('account.login')
            ->withInput()
            ->with('error', 'Ungültige E-Mail oder Passwort.');
    }

    public function register()
    {
        return view('register');
    }

    public function processRegister(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:users',
            'password' => ['required', 'min:8'],
            'first_name' => 'required',
            'last_name' => 'required',
        ], [
            'email.required' => 'E-Mail ist erforderlich.',
            'email.email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'email.unique' => 'Diese E-Mail-Adresse wird bereits verwendet.',
            'password.required' => 'Passwort ist erforderlich.',
            'password.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
            'first_name.required' => 'Vorname ist erforderlich.',
            'last_name.required' => 'Nachname ist erforderlich.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }
    
        $lastUser = User::whereNotNull('std_id')->latest('id')->first();
        $lastNumber = $lastUser ? (int) substr($lastUser->std_id, 3) : 0;
        $newStdId = 'STU' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    
        $user = new User();
        $user->firstName = $req->first_name;
        $user->lastName = $req->last_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->role = 'user';
        $user->std_id = $newStdId;
        $user->email_verified_at = null;
        $user->save();
    
        session([
            'temp_user_id' => $user->id,
            'temp_email' => $req->email,
            'temp_password' => $req->password,
        ]);
    
        return redirect()->route('student.upload.card');
    }

    public function showUploadCardForm(Request $request)
    {
        if (!session()->has('temp_user_id')) {
            return redirect()
                ->route('account.login')
                ->withErrors([__('auth.login_first')]);
        }

        $user = User::find(session('temp_user_id'));

        if (!$user) {
            session()->forget(['temp_user_id', 'temp_email', 'temp_password']);
            return redirect()
                ->route('account.login')
                ->withErrors([__('auth.user_not_found')]);
        }

        return view('auth.upload-student-card', compact('user'));
    }

    public function verifyStudentCard(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'student_card' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($req->user_id);
        if (!$user) {
            return redirect()
                ->route('account.register')
                ->withErrors(['auth.user_not_found']);
        }

        $file = $req->file('student_card');
        $fileName = 'student_card_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('register/student_cards'), $fileName);

        $user->student_card = 'register/student_cards/' . $fileName;

        $isStudent = $this->verifyWithGeminiAI(public_path($user->student_card));

        if ($isStudent) {
            $user->accept_card = 1;
            $user->save();

            $users = User::findOrFail($user->id);
            $user->email_verified_at = 1;
            $user->save();

            // if (is_null($user->email_verified_at)){

            //     Mail::to($user->email)->send(new VerifyEmail($user));

            //     return view('auth.verify', ['email' => $user->email]);
            // }
            Auth::login($user);
            return redirect()->route('account.dashboard')->with('success', __('auth.verified_user'));
        } else {
            $user->accept_card = 0;
            $user->save();
            return back()->with('error', __('auth.invalid_student'));
        }
    }

    private function verifyWithGeminiAI($imagePath)
    {
        $apiKey = env('GEMINI_API_KEY');

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";

        $fileContent = file_get_contents($imagePath);
        $mimeType = mime_content_type($imagePath);

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'inline_data' => [
                                'mime_type' => $mimeType,
                                'data' => base64_encode($fileContent),
                            ],
                        ],
                        [
                            'text' => __('auth.is_valid_student'),
                        ],
                    ],
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        $result = $response->json();

        if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            $aiResponse = strtolower($result['candidates'][0]['content']['parts'][0]['text']);

            return preg_match('/yes|ja|جی ہاں|valid|correct|true/i', $aiResponse);
        }

        return false;
    }

    public function verifyEmail(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            return redirect()->route('account.login')->with('error', __('auth.expired_verification'));
        }

        $user = User::findOrFail($id);
        $user->email_verified_at = 1;
        $user->save();

        $courseId = session('course_id');
        session()->forget('course_id'); // Remove course_id from session
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function resendVerificationEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->email_verified_at) {
            return redirect()->route('account.login')->with('error', __('auth.email_already_verified'));
        }

        Mail::to($user->email)->send(new VerifyEmail($user));
        return response()->json(['success' => __('auth.verification_email_sent')]);
    }

    public function logout()
    {
        $courseId = session('course_id');
        session()->forget('course_id'); // Remove course_id from session
        session()->forget('post_cat_id'); // Remove course_id from session
        session()->forget('pending_comment'); // Remove course_id from session
        session()->forget('meett_cat_id'); // Remove course_id from session
        session()->forget('meett_cat_main_id'); // Remove course_id from session

        Auth::logout();
        return redirect()->route('account.login');
    }

    public function register_google()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar', 'https://www.googleapis.com/auth/calendar.events', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->redirect();
    }

    public function callbackFromGoogleregister()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $role = 'user';
        $lastUser = User::whereNotNull('std_id')->latest('id')->first();
        $lastNumber = $lastUser ? (int) substr($lastUser->std_id, 3) : 0;
        $newStdId = 'STU' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => Hash::make($googleUser->getEmail() . '@' . $googleUser->getId()),
                'role' => $role,
                'std_id' => $newStdId,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        } else {
            $user->google_token = $googleUser->token;
            $user->google_refresh_token = $googleUser->refreshToken;
            $user->save();
        }
        session([
            'temp_user_id' => $user->id,
            'temp_email' => $user->email,
            'temp_password' => Hash::make($googleUser->getEmail() . '@' . $googleUser->getId()),
        ]);
        if ($user->accept_card == 1) {
            if (is_null($user->email_verified_at)) {
                Mail::to($user->email)->send(new VerifyEmail($user));

                return view('auth.verify', ['email' => $user->email]);
            }
            Auth::login($user);
            return redirect()->route('account.dashboard');
        }

        return redirect()->route('student.upload.card');
    }

    public function facebook_login()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebbokregister()
    {
        $googleUser = Socialite::driver('facebook')->stateless()->user();

        $role = 'user';

        $lastUser = User::whereNotNull('std_id')->latest('id')->first();
        $lastNumber = $lastUser ? (int) substr($lastUser->std_id, 3) : 0;
        $newStdId = 'STU' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        $user = User::updateOrCreate(
            [
                'email' => $googleUser->getEmail(),
            ],
            [
                'facebook_id' => $googleUser->getId(),
                'password' => Hash::make($googleUser->getEmail() . '@' . $googleUser->getId()),
                'role' => $role,
                'std_id' => $newStdId,
            ],
        );

        Auth::login($user);

        return redirect()->route('account.dashboard');
    }
    public function logoutsession(Request $request)
    {
        $request->session()->forget('temp_user_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('account.login')->with('message', __('auth.logged_out'));
    }

    public function redirectToGitHub()
    {
        return Socialite::driver('github')
            ->scopes(['user:email'])
            ->redirect();
    }
    public function handleGitHubCallback()
    {
        $githubUser = Socialite::driver('github')->stateless()->user();

        $role = 'user';

        // Generate std_id like Google
        $lastUser = User::whereNotNull('std_id')->latest('id')->first();
        $lastNumber = $lastUser ? (int) substr($lastUser->std_id, 3) : 0;
        $newStdId = 'STU' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        $user = User::where('email', $githubUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'email' => $githubUser->getEmail(),
                'github_id' => $githubUser->getId(),
                'password' => Hash::make($githubUser->getEmail() . '@' . $githubUser->getId()),
                'role' => $role,
                'std_id' => $newStdId,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken ?? null,
            ]);
        } else {
            $user->github_token = $githubUser->token;
            $user->github_refresh_token = $githubUser->refreshToken ?? null;
            $user->save();
        }

        session([
            'temp_user_id' => $user->id,
            'temp_email' => $user->email,
            'temp_password' => Hash::make($githubUser->getEmail() . '@' . $githubUser->getId()),
        ]);

        if ($user->accept_card == 1) {
            if (is_null($user->email_verified_at)) {
                Mail::to($user->email)->send(new VerifyEmail($user));
                return view('auth.verify', ['email' => $user->email]);
            }
            Auth::login($user);
            return redirect()->route('account.dashboard');
        }

        return redirect()->route('student.upload.card');
    }
}
