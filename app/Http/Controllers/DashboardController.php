<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\AffliatePrograms;
use App\Models\CareerJobs;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Enroll;
use App\Models\Follower;
use App\Models\Post;
use App\Models\Task;
use App\Models\TravelMobility;
use App\Models\TravelMobilityCategories;
use App\Models\User;
use App\Models\userpost;

use App\Models\Workshops;
use Barryvdh\DomPDF\Facade\Pdf;
use Google\Client;
use Google\Service\GenerativeLanguage;

use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use App\Models\meet;
class DashboardController extends Controller
{
    
public function create_user_post($id)
{
    if (!Auth::check()) {

        session()->put('post_cat_id', $id);
        return redirect()->route('account.login');
    }

    session()->put('post_cat_id', $id);

    return redirect()->route('account.community');
}

    
public function session_meet($slug)
{
    
    $category = meet::
                 whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$slug])
                 ->with('child')
                 ->firstOrFail();


    if (!Auth::check()) {

        session()->put('meett_cat_id', $slug);
        session()->put('meett_cat_main_id', $category->id);
        return redirect('account/login');
    }

    session()->put('meett_cat_id', $slug);
        session()->put('meett_cat_main_id', $category->id);
    return redirect()->url('meet/categry/'.$slug);
}


  
  public function updateProfile(Request $req, $id)
  {
      $data = User::findOrFail($id);

      $data->firstName = $req->firstName;
      $data->lastName = $req->lastName;
      $data->email = $req->email;
      $data->job_category = $req->job_category;
      $data->job_id = $req->job_id;
      $data->interest_workshop = $req->interest_workshop;
      $data->interest_travel = $req->interest_travel;
      $data->interest_affilates = $req->interest_affilates;

      $data->goals = $req->goal;
      $data->current_priogress = $req->current_priogress;
      $data->subject = $req->subject;
      

      $data->student_tutor = $req->student_tutor;
      $data->university_name = $req->university_name;


      if ($req->hasFile('profile')) {
          $oldImagePath = public_path('Images/' . $data->profile);
          
          if ($data->profile && file_exists($oldImagePath)) {
              unlink($oldImagePath);
          }

          $file = $req->file('profile');
          $filename = uniqid() . '.' . $file->getClientOriginalExtension();
          $file->move(public_path('Images'), $filename);


          $data->profile = $filename;
      }

      $data->save();
      return redirect()->route('account.profile')->with('success', __('messages.user.Profile'));

  }
  public function userProfile() {
    $item = Auth::user();
    $workshop = $item->interest_workshop;
    $travel = $item->interest_travel;
    $affilate = $item->interest_affilates;
    
    $job_cate = $item->job_category;
    $job = $item->job_id;

    return view('user.profile', compact('item', 'workshop', 'travel', 'affilate', 'job_cate', 'job'));
}


  public function index(){
    
    return view('user.dashboard');
  }

  public function Workshops(){

    $data = Workshops::all();
    return view ('workshops',compact('data'));
  }

  public function ai(){
    return view('user.ai');
  }

  public function document(){
    return view('user.document');
  }

  public function workshopDetail($id){
    $data = Workshops::find($id);
    return view('workshop-detail',compact('data'));
  }

  public function AffiliateDetail($id){
    $data = AffliatePrograms::find($id);
    return view('affiliate-programs-detail',compact('data'));
  }

  public function Affiliate(){
    $data = AffliatePrograms::all();
    return view ('affiliate-programs',compact('data'));
  }
  
  public function forum(){
    return view ('forum.forum');
  }


public function forum_forum($id, Request $request)
{
    $cat = Category::where('slug', $id)->first();

    if (!$cat) {
        abort(404);
    }

    $userPosts = collect(); // Initialize empty collection

    if (Auth::check()) {
        $userPosts = UserPost::where('parent_id', $cat->id)
            ->where('user_id', Auth::id())
            ->get();
    }

    // Get all admin posts (Post model)
    $adminPosts = Post::where('parent_id', $cat->id)->get();

    // Get other users' UserPosts (excluding current user's)
    $otherUserPosts = userpost::where('parent_id', $cat->id)
        ->when(Auth::check(), function ($query) {
            return $query->where('user_id', '!=', Auth::id());
        })
        ->get();

    // Merge all: user's posts first, then admin + others, sorted by created_at
    $allPosts = $userPosts
        ->merge($adminPosts)
        ->merge($otherUserPosts)
        ->sortByDesc('created_at')
        ->values();

    // Manual pagination
    $perPage = 10;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $paginatedPosts = new LengthAwarePaginator(
        $allPosts->forPage($currentPage, $perPage),
        $allPosts->count(),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    // Handle Ajax request
    if ($request->ajax()) {
        return response()->json([
            'products' => view('forum.forum_forum_partial', ['post' => $paginatedPosts])->render(),
            'pagination' => $paginatedPosts->links('vendor.pagination.numbers')->render()
        ]);
    }

$totalFollowerCount = 0;
$postIds = Post::where('parent_id', $cat->id)->pluck('id')->toArray();

$userPostIds = userpost::where('parent_id', $cat->id)->pluck('id')->toArray();

$totalFollowerCount = Follower::whereIn('user_post_id', array_merge($postIds, $userPostIds))->count();
    // Regular view return
    return view('forum.forum_forum', [
        'cat' => $cat,
        'post' => $paginatedPosts,
    'totalFollowerCount' => $totalFollowerCount,

    ]);
}





public function forum_topic($id)
{
    // 1. Find Post or UserPost
    $post = Post::where('slug', $id)->first();
    $modelType = 'post';

    if (!$post) {
        $post = UserPost::where('slug', $id)->first();
        $modelType = 'userpost';
    }

    if (!$post) {
        abort(404);
    }

    // 2. Unique Key for View Tracking
    $cookieKey = "viewed_{$modelType}_{$post->id}";

    // 3. Check if user already viewed (via cookie)
    if (!request()->hasCookie($cookieKey)) {
        // Increment view count manually
        if ($modelType === 'post') {
            DB::table('posts')
              ->where('id', $post->id)
              ->update(['views' => DB::raw('views + 1')]);
        } else {
            DB::table('userposts')
              ->where('id', $post->id)
              ->update(['views' => DB::raw('views + 1')]);
        }

        // Set cookie for 1 day (can adjust)
        cookie()->queue(cookie($cookieKey, true, 60 * 24)); // 24 hours
    }

    return view('forum.topic_forum', compact('post'));
}


  public function career()
  {
    return view('career');
  }

  public function jobs($id)
  {
    $job=CareerJobs::where('slug',$id)->first();
    $jobcat=CareerJobs::where('parent_id',$job->id)->where('status',1)->get();

    return view('jobs',compact('job','jobcat'));
  }

  public function jobs_detail($id)
  {
    $job=CareerJobs::where('slug',$id)->first();

    return view('jobs_detail',compact('job'));
  }

  public function TravelMobility(){
    $data = TravelMobilityCategories::all();
    return view('travel-mobility',compact('data'));
  }

  public function TravelMobilitySubCategory($id)
  {
    $data = TravelMobility::where('category_id', $id)->get();
    $cid = $id;

    return view('travel-mobility-sub-category',compact('data','cid'));
  }


  public function TravelMobilityDetails($id){
    $data = TravelMobility::find($id);
    return view('travel-mobility-details',compact('data'));
  }

  public function Notification(){
    return view('user.notification');
  }

  public function Financial_Planning(){
    return view('user.Financial_Planning');
  }

  public function Study_Assistant(){
    return view('user.study_assistant');
  }

  public function careerPlanning(){
    return view('user.career_planning');
  }

  public function Community(){
    return view('user.community');
  }
        
  public function markAsRead(Request $request)
  {
      $userId = auth()->id();

      Task::where('user_id', $userId)
          ->whereDate('due_date', now()->toDateString())
          ->update(['is_read' => true]);

      Enroll::where('user_id', $userId)
          ->whereDate('book_date', now()->toDateString())
          ->update(['is_read' => true]);

      return response()->json(['message' => __('messages.mark_as_read')]);
  }
      
  public function user_workshopshow()
  {
    return view('user.workshop_showuser');
  }

  public function user_ticketbook()
  {
    return view('user.ticketbook_suershow');
  }

  public function user_affiliate_programs()
  {
    return view('user.user_affiliate_programs');
  }

  public function calendar_task()
  {
    return view('user.task');
  }
  public function task_show()
  {
    $tasks = Task::all();

    $events = [];

    foreach ($tasks as $task) {
        $events[] = [
            'id' => $task->id,
            'title' => $task->name,
            'start' => $task->start_date,
            'end' => $task->end_date ?? $task->start_date,
        ];
    }

    return response()->json($events);
  }

  public function getJobs(Request $request)
  {
      $jobs = CareerJobs::where('parent_id', $request->category_id)->get();
      return response()->json($jobs);
  }

  public function interestnoti()
  {
    return view('user.interset');

  }

public function processDocument(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'document' => 'required|mimes:jpeg,png,jpg,pdf,webp|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()->first()], 422);
    }

    $file = $request->file('document');
    $filePath = $file->store('documents', 'public');
    $fileContent = file_get_contents(storage_path("app/public/{$filePath}"));

    $apiKey = env('GEMINI_API_KEY');
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";

    $payload = [
        "contents" => [
            [
                "parts" => [
                    [
                        "inline_data" => [
                            "mime_type" => $file->getMimeType(),
                            "data" => base64_encode($fileContent)
                        ]
                    ]
                ]
            ]
        ]
    ];

    $response = Http::post($url, $payload);

    if ($response->failed()) {
        return response()->json(['error' => 'Failed to process the document.'], 500);
    }

    $data = $response->json();
    $extractedText = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No text extracted.';

    // ✅ Remove all asterisks (*)
    $extractedText = str_replace('*', '', $extractedText);

    return response()->json(['text' => $extractedText]);
}

public function analyzeFinances(Request $request)
{
    $request->validate([
        'income' => 'required|numeric|min:0',
        'expenses' => 'required|numeric|min:0',
        'savings' => 'required',
        'goals' => 'required|string|max:255',
    ]);

    $data = $request->only(['income', 'expenses', 'savings', 'goals']);
    $apiKey = env('GEMINI_API_KEY');
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";

    $prompt = "Analyze the following financial data and provide personalized financial planning recommendations:
    - Monthly Income: {$data['income']}
    - Monthly Expenses: {$data['expenses']}
    - Current Savings: {$data['savings']}
    - Financial Goal: {$data['goals']}
    - Suggest a monthly budget plan, savings strategy, and investment advice.";

    $payload = [
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ]
    ];

    sleep(1); // Optional delay to avoid rate limits

    $response = Http::post($url, $payload);

    if ($response->failed()) {
        return response()->json(['error' => 'API request failed: '.$response->body()]);
    }

    $responseData = $response->json();

    $aiTextRaw = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'No financial advice generated.';

    // Remove markdown formatting like **bold**, *italic*, _underline_, etc.
    $aiText = preg_replace('/(\*\*|\*|__|_)(.*?)\1/', '$2', $aiTextRaw);

    // Remove # headings (Markdown style)
    $aiText = preg_replace('/#+\s*/', '', $aiText); // Remove # and any trailing space

            $aiText = str_replace('*', '', $aiText);
            
    return response()->json(['analysis' => $aiText]);
}


 public function improve(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'tone' => 'nullable|string|max:100',
        ]);

        $text = $request->input('text');
        $tone = $request->input('tone') ?: 'Standard verbessern';

        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";

        $prompt = "Bitte verbessere den folgenden Text in Grammatik, Rechtschreibung und Stil. 
        Verwende den gewünschten Ton: '{$tone}'. 
        Text: {$text}";

        $payload = [
            "contents" => [
                ["parts" => [["text" => $prompt]]]
            ]
        ];

        sleep(1); // just to slow down a bit, optional
        $response = Http::post($url, $payload);

        if ($response->failed()) {
            return response()->json(['error' => 'Fehler beim Analysieren des Textes.']);
        }

        $responseData = $response->json();
        $improvedText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Keine Verbesserung generiert.';

        return response()->json(['improved' => $improvedText]);
    }
    public function exportPdf(Request $request)
{
    $request->validate([
        'content' => 'required|string'
    ]);

    $pdf = Pdf::loadView('export.document', [
        'content' => $request->input('content')
    ]);

    return $pdf->download('document.pdf');
}
    public function downloadResumePdf(Request $request)
{
      $request->validate([
        'resume' => 'required|string',
        'coverLetter' => 'required|string'
    ]);

    $resume = $request->input('resume');
    $coverLetter = $request->input('coverLetter');

    // Create a PDF view
    $pdf = Pdf::loadView('pdf.resume_cover_letter', [
        'resume' => $resume,
        'coverLetter' => $coverLetter
    ]);

    return $pdf->download('resume_and_cover_letter.pdf');
}




public function exportWord(Request $request)
{
    $request->validate([
        'content' => 'required|string'
    ]);

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    $section->addText(strip_tags($request->input('content')));

    $fileName = 'document.docx';
    $tempFile = tempnam(sys_get_temp_dir(), $fileName);
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($tempFile);

    return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
}

public function loadMore(Request $request)
{
    $offset = $request->input('offset', 0);
    $userId = auth()->id();

    $postIds = Comment::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->pluck('post_id')
        ->unique()
        ->slice($offset, 3)
        ->values();

    $posts = Post::whereIn('id', $postIds)->get();

    $html = view('partials.discussions', compact('posts'))->render();

    return response()->json(['html' => $html]);
}

public function search(Request $request)
{
    $query = $request->get('query');

    $users = User::where(function ($q) use ($query) {
        $q->whereRaw("CONCAT(firstName, ' ', lastName) LIKE ?", ["%{$query}%"])
          ->orWhere('firstName', 'LIKE', "%{$query}%")
          ->orWhere('lastName', 'LIKE', "%{$query}%")
          ->orWhere('university_name', 'LIKE', "%{$query}%");
    })->get();

    $results = $users->map(function ($user) {
        $fullName = trim($user->firstName . ' ' . $user->lastName);
        $parts = [];

        if ($user->university_name) {
            $parts[] = '(' . $user->university_name . ')';
        }

        if ($user->student_tutor == 1) {
            $parts[] = '(Student)';
        } elseif ($user->student_tutor == 2) {
            $parts[] = '(Tutor)';
        }

        return $fullName . (count($parts) > 0 ? ' ' . implode(', ', $parts) : '');
    });

    return response()->json($results);
}


public function meet()
{
    $meet = meet::where('parent_id',0)->get();
    return view('meet',compact('meet'));
}
public function meetcategory($slug)
{
    $category = meet::where('parent_id', 0)
                 ->whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$slug])
                 ->with('child')
                 ->firstOrFail();
    $child = meet::where('parent_id',$category->id)->latest()->get();

    return view('meetcategory', compact('category','child'));
}

public function meetcategorydetail($slug)
{
    $category = meet::slugwhereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$slug])
                 ->with('c
                 dd();hild')
                 ->firstOrFail();


    return view('meetcategory', compact('category','child'));
}


public function searchmeet(Request $request)
{
    $query = $request->get('query');

    $meets = meet::where('name', 'LIKE', "%{$query}%")
        ->orderBy('name', 'asc')
        ->take(10)
        ->get(['id', 'name', 'parent_id']);

    // Format the data with URLs
    $results = $meets->map(function($meet) {
        if ($meet->parent_id == 0) {
            // Self name slug
            $slug = Str::slug($meet->name);
        } else {
            // Get parent name slug
            $parent = meet::find($meet->parent_id);
            $slug = $parent ? Str::slug($parent->name) : Str::slug($meet->name);
        }

        return [
            'id'   => $meet->id,
            'name' => $meet->name,
            'url'  => url("meet/category/{$slug}")
        ];
    });

    return response()->json($results);
}





}
