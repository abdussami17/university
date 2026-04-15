<?php
namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\QuizAttempt;
use App\Models\User;

class QuizController extends Controller
{
public function generateQuiz(Request $request)
{
    $request->validate([
        'topic' => 'required|string',
        'level' => 'required|string',
        'num_questions' => 'required|integer'
    ]);

    $topic = $request->input('topic');
    $difficulty = $request->input('level');
    $numQuestions = $request->input('num_questions', 3);

    $apiKey = env('GEMINI_API_KEY');
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";

    $prompt = "Generate a {$difficulty} level quiz with {$numQuestions} questions about '{$topic}'.
Only give the questions, do NOT include answers. 
Format strictly as:
Q1: Question text
Q2: Question text
and so on.";

    $payload = [
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ]
    ];

    $response = Http::post($url, $payload);

    if ($response->failed()) {
        return response()->json(['error' => 'Fehler beim Quiz generieren.']);
    }

    $quizText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Keine Fragen erhalten.';

    // Auto calculate time
    switch (strtolower($difficulty)) {
        case 'easy':
            $perQuestionTime = 1;
            break;
        case 'medium':
            $perQuestionTime = 2;
            break;
        case 'hard':
            $perQuestionTime = 3;
            break;
        default:
            $perQuestionTime = 2; // default medium
    }
    $timeEstimate = $numQuestions * $perQuestionTime;

    // Save in DB
    QuizQuestion::create([
        'topic' => $topic,
        'level' => $difficulty,
        'num_questions' => $numQuestions,
        'questions' => $quizText,
        'time' => $timeEstimate,
        'user_id'=> auth()->user()->id,
    ]);

    return response()->json([
        'quiz' => nl2br($quizText),
        'time_estimate' => $timeEstimate,
        'message' => 'Quiz erfolgreich erstellt und gespeichert.'
    ]);
}


public function quizquestionsolver(Request $request)
{
    $quiz = QuizQuestion::findOrFail($request->id);
    $userId = auth()->id();

    $attempt = QuizAttempt::where('quiz_question_id', $quiz->id)
                          ->where('user_id', $userId)
                          ->first();

    $userAnswers = $attempt ? json_decode($attempt->answers, true) : [];

    return view('user.solvequestion', compact('quiz', 'attempt', 'userAnswers'));
}

public function submitQuizAttempt(Request $request)
{
    $request->validate([
        'quiz_id' => 'required|integer|exists:quiz_questions,id',
        'answers' => 'required|array',
        'time_taken' => 'required|string'
    ]);

    $quiz = QuizQuestion::findOrFail($request->quiz_id);
    $answers = $request->input('answers');
    $timeTaken = $request->input('time_taken');
    $formattedAnswers = json_encode($answers, JSON_PRETTY_PRINT);

    $prompt = <<<EOD
Check the following user answers for the quiz. Evaluate them and give a score out of 100.

QUIZ QUESTIONS:
{$quiz->questions}

USER ANSWERS:
""" 
$formattedAnswers
"""

Respond only with valid JSON in this exact format (no explanation or markdown):

{
  "evaluation": "short feedback here",
  "score": 85
}
EOD;

    $apiKey = env('GEMINI_API_KEY');
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";

    $payload = [
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ]
    ];

    $response = Http::post($url, $payload);

    if ($response->failed()) {
        return response()->json(['error' => 'AI grading failed.']);
    }

    $jsonText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
    $data = json_decode($jsonText, true);

    if (!$data) {
        preg_match('/\{.*\}/s', $jsonText, $matches);
        if (isset($matches[0])) {
            $data = json_decode($matches[0], true);
        }
    }

    if (!$data || !isset($data['score'])) {
        return response()->json([
            'error' => 'AI JSON parsing failed.',
            'raw' => $jsonText
        ]);
    }

    $evaluation = $data['evaluation'] ?? 'No evaluation.';
    $score = $data['score'];

    // XRP calculation
    if ($score >= 70) {
        $xrpEarned = 2;
    } elseif ($score >= 40) {
        $xrpEarned = 1;
    } else {
        $xrpEarned = 0;
    }

    $user = User::find(auth()->id());
    $maxXRP = 1000;
    $currentXRP = $user->total_xrp ?? 0;

    if ($currentXRP + $xrpEarned > $maxXRP) {
        $xrpEarned = max(0, $maxXRP - $currentXRP);
    }

    $newTotalXRP = $currentXRP + $xrpEarned;

    // 🔁 Update or Create
    $attempt = QuizAttempt::where('quiz_question_id', $quiz->id)
        ->where('user_id', $user->id)
        ->first();

    if ($attempt) {
        $attempt->update([
            'answers' => json_encode($answers),
            'evaluation' => $evaluation,
            'score' => $score,
            'time_taken' => $timeTaken,
            'xp_earned' => $xrpEarned,
        ]);
    } else {
        QuizAttempt::create([
            'quiz_question_id' => $quiz->id,
            'user_id' => $user->id,
            'answers' => json_encode($answers),
            'evaluation' => $evaluation,
            'score' => $score,
            'time_taken' => $timeTaken,
            'xp_earned' => $xrpEarned,
        ]);
    }

// After saving the attempt...
$totalEarnedXRP = QuizAttempt::where('user_id', $user->id)->sum('xp_earned');
$maxXRP = 1000;
$newTotalXRP = min($totalEarnedXRP, $maxXRP);

$user->forceFill([
    'total_xp' => $newTotalXRP,
])->save();


    return response()->json([
        'evaluation' => $evaluation,
        'score' => $score,
        'xrp' => $xrpEarned,
        'total_xrp' => $newTotalXRP,
        'message' => $attempt ? 'Quiz attempt updated. XRP updated.' : 'Quiz attempt saved. XRP awarded.'
    ]);
}




}
