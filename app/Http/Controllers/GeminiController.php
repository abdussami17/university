<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\UserSkillProgress;
use App\Models\AiChatHistory;


class GeminiController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required'
        ]);

        $inputText = $request->prompt;


        $summaryPrompt = __('messages.summarize_text') . "\n\n" . $inputText;
        $summaryResponse = $this->geminiService->generateText($summaryPrompt);
        $summaryText = $summaryResponse['candidates'][0]['content']['parts'][0]['text'] ?? __('messages.no_summary');


        $flashCardPrompt = __('messages.create_flashcards') . "\n\n" . $inputText;
        $flashCardResponse = $this->geminiService->generateText($flashCardPrompt);
        $flashCards = $flashCardResponse['candidates'][0]['content']['parts'][0]['text'] ?? __('messages.no_flashcards');

        $mindMapPrompt = __('messages.structured_map') . "\n\n" . $inputText;
        $mindMapResponse = $this->geminiService->generateText($mindMapPrompt);
        $mindMap = $mindMapResponse['candidates'][0]['content']['parts'][0]['text'] ?? __('messages.no_map');

        return response()->json([
            'summary' => $summaryText,
            'flash_cards' => $flashCards,
            'mind_map' => $mindMap
        ]);
    }
public function generateResume(Request $request)
{
    $request->validate([
        'jobDescription' => 'required|string',
        'skills' => 'required|string',
        'experience' => 'nullable|string'
    ]);

    $jobDescription = $request->input('jobDescription');
    $skills = $request->input('skills');
    $experience = $request->input('experience');

    $combinedPrompt = "Stellenbeschreibung:\n" . $jobDescription . "\n\n"
        . "Fähigkeiten & Erfahrungen:\n" . $skills . "\n\n"
        . "Bisherige Berufserfahrung:\n" . ($experience ?: "Keine weiteren Angaben.");

    $apiKey = env('GEMINI_API_KEY');
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";

    $resumePrompt = "Erstelle einen professionellen Lebenslauf basierend auf den folgenden Informationen:\n\n" . $combinedPrompt;
    $coverLetterPrompt = "Erstelle ein überzeugendes Motivationsschreiben basierend auf den folgenden Informationen:\n\n" . $combinedPrompt;

    $resumeResponse = Http::post($url, [
        "contents" => [
            ["parts" => [["text" => $resumePrompt]]]
        ]
    ]);

    $coverLetterResponse = Http::post($url, [
        "contents" => [
            ["parts" => [["text" => $coverLetterPrompt]]]
        ]
    ]);

    $resumeText = $resumeResponse->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Fehler beim Erstellen des Lebenslaufs.';
    $coverLetterText = $coverLetterResponse->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Fehler beim Erstellen des Motivationsschreibens.';

    // Clean Markdown
    $cleanedResume = $this->cleanMarkdown($resumeText);
    $cleanedCoverLetter = $this->cleanMarkdown($coverLetterText);

    // Remove HTML tags first
    $plainResume = strip_tags($cleanedResume);
    $plainCoverLetter = strip_tags($cleanedCoverLetter);

    // Make heading-like lines bold in plain text using ** markers
    // Matches lines that start with a word and end with :
    $boldedResume = preg_replace('/^(.+?):$/m', '**$1:**', $plainResume);
    $boldedCoverLetter = preg_replace('/^(.+?):$/m', '**$1:**', $plainCoverLetter);

    return response()->json([
        'resume' => $boldedResume,
        'coverLetter' => $boldedCoverLetter,
    ]);
}


private function cleanMarkdown($text)
{
    // Remove bold **text** or __text__
    $text = preg_replace('/(\*\*|__)(.*?)\1/', '$2', $text);

    // Remove italic *text* or _text_
    $text = preg_replace('/(\*|_)(.*?)\1/', '$2', $text);

    // Remove headings ###, ##, #
    $text = preg_replace('/^#{1,6}\s*/m', '', $text);

    // Remove inline code `code`
    $text = preg_replace('/`([^`]+)`/', '$1', $text);

    // Remove list markers (-, *, +)
    $text = preg_replace('/^(\s*[-*+])\s*/m', '', $text);

    return $text;
}


    
    
    public function stress_manag()
    {
        return view('user.indexstress');
    }

    
    public function generateTips(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $userDetails = $request->input('prompt');

        $promptText = __('messages.stress_management') . "\n" . $userDetails;

        $response = $this->geminiService->generateText($promptText);

        // Extract AI-generated response
        $resumeText = $response['candidates'][0]['content']['parts'][0]['text'] ?? __('messages.tips_failed');


        return response()->json(['tips' => $resumeText]);
    }
    

 public function relavant_workshop()
    {
        return view('user.relavantindex');

    }

// AI-Based Recommendations
public function recommendWorkshops(Request $request)
{
    $request->validate([
        'interest' => 'required|string',
    ]);

    $interest = $request->input('interest');

    // 🔥 Improved Prompt for Full Paragraph Output
    $promptText = __('messages.workshop_recommendations', ['interest' => $interest]);

    $response = $this->geminiService->generateText($promptText);
    
    $workshops = $response['candidates'][0]['content']['parts'][0]['text'] ?? __('messages.no_recommendations');

    return response()->json(['workshops' => nl2br($workshops)]);
}
public function recommendEvents(Request $request)
{
    $request->validate([
        'interest' => 'required|string',
    ]);

    $interest = $request->input('interest');

    // 🔥 AI Prompt for Event Recommendations
    $promptText = __('messages.upcoming_events', ['interest' => $interest]);

    $response = $this->geminiService->generateText($promptText);

    // ✅ Extract AI response correctly
    $events = $response['candidates'][0]['content']['parts'][0]['text'] ?? __('messages.no_recommendations');

    return response()->json(['events' => explode("\n", strip_tags($events))]);
}


// 2️⃣ Automatic Event Registration
public function registerEvent(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
    ]);

    $userId = Auth::id();
    $eventId = $request->input('event_id');

    EventRegistration::create([
        'user_id' => $userId,
        'event_id' => $eventId,
    ]);

    return response()->json(['message', __('messages.registered_for_event')]);
}    

public function checkPlagiarism(Request $request)
{
    $request->validate([
        'text' => 'required|string'
    ]);

    $text = $request->input('text');
    $apiKey = env('GEMINI_API_KEY');
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";

    $prompt = "Check the following text for plagiarism. 
    Indicate any parts that might be copied, paraphrased from known sources, 
    or are suspicious. Also give a uniqueness estimate percentage. 

    Text to check:
    {$text}";

    $payload = [
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ]
    ];

    $response = Http::post($url, $payload);

    if ($response->failed()) {
        return response()->json(['error' => 'Fehler beim Plagiat-Check.']);
    }

    $resultText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Keine Analyse erhalten.';

    // 🔴 Remove Markdown bold (**text**) if present
    $cleanedText = preg_replace('/\*\*(.*?)\*\*/', '$1', $resultText);

$cleanedText = str_replace(['*', '#'], '', $resultText);
            
    return response()->json(['result' => nl2br($cleanedText)]);
}


public function skillcoach()
{
    
     $user = auth()->user();
    $xp = $user->total_xp ?? 0;
    $level = $this->getLevelFromXP($xp);
    $nextLevelXP = $level['next'];
    $currentLevelName = $level['name'];
    $progress = round(($xp / $nextLevelXP) * 100);

    $badges = [
        'Lernerfolg' => 'bi-award',
        'Community Star' => 'bi-star',
        'Fokus-Meister' => 'bi-lightbulb',
        'Dokumenten-Profi' => 'bi-file-earmark-text',
    ];
    
    return view('user.skillcoach', compact('xp', 'nextLevelXP', 'currentLevelName', 'progress', 'badges'));
}

private function getLevelFromXP($xp)
{
    if ($xp >= 2000) {
        return ['name' => 'Platin-Lerner', 'next' => 3000];
    } elseif ($xp >= 1250) {
        return ['name' => 'Gold-Lerner', 'next' => 2000];
    } elseif ($xp >= 750) {
        return ['name' => 'Silber-Lerner', 'next' => 1250];
    } elseif ($xp >= 300) {
        return ['name' => 'Bronze-Lerner', 'next' => 750];
    }
    return ['name' => 'Starter', 'next' => 1000];
}

public function storeskillpath(Request $request)
{
    $request->validate([
        'skill_path_id' => 'required|exists:skill_paths,id'
    ]);

    $user = auth()->user();
    $skillPathId = $request->skill_path_id;

    // if user already has record, update it, otherwise create new
    UserSkillProgress::updateOrCreate(
        ['user_id' => $user->id],
        ['skill_path_id' => $skillPathId]
    );

    return response()->json([
        'message' => 'Skill path saved successfully!',
        'skill_path_id' => $skillPathId
    ]);
}

    public function showTool($tool)
    {
        $tools = [
            'timebox' => 'AI Timebox Planner',
            'calendar-sync' => 'Intelligent Calendar Synchronization',
            'idea-generator' => 'AI Idea Generator',
            'exam-countdown' => 'Exam Countdown',
            'task-party' => 'Task Party',
            'flashcard' => 'Flashcard Magic'
        ];

        if (!isset($tools[$tool])) {
            abort(404);
        }

        return view('user.toolkit.tool', [
            'tool' => $tool,
            'title' => $tools[$tool]
        ]);
    }
    
    
    
    public function Toolkit()
    {
        return view('user.toolkit.toolkit');
        
    }
    

    public function runTool(Request $request, $tool)
    {
        $request->validate([
            'input' => 'required|string'
        ]);

        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}";
        $input = $request->input('input');

        // Tool-specific prompts
        $prompts = [
            'timebox' => "Create a timeboxed daily schedule for the following tasks:\n\n{$input}",
            'calendar-sync' => "Analyze this calendar input and suggest optimized scheduling:\n\n{$input}",
            'idea-generator' => "Generate creative ideas and structure for the following topic:\n\n{$input}",
            'exam-countdown' => "Create a study countdown plan for this exam schedule:\n\n{$input}",
            'task-party' => "Gamify the following tasks with names and rewards:\n\n{$input}",
            'flashcard' => "Convert the following content into Q&A flashcards:\n\n{$input}",
        ];

        if (!isset($prompts[$tool])) {
            return response()->json(['error' => 'Ungültiges Tool.'], 400);
        }

        $payload = [
            "contents" => [
                ["parts" => [["text" => $prompts[$tool]]]]
            ]
        ];

        $response = Http::post($url, $payload);

        if ($response->failed()) {
            return response()->json(['error' => 'KI konnte nicht antworten.']);
        }



        $aiTextRaw = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Keine Antwort erhalten.';

    $result = preg_replace('/(\*\*|\*|__|_)(.*?)\1/', '$2', $aiTextRaw);


        return response()->json([
            'tool' => $tool,
            'result' => nl2br($result)
        ]);
    }
    
    public function careerassistant()
    {
        $messages=AiChatHistory::where('user_id',auth()->user()->id)->get();
        return view('user.chat-assistant',compact('messages'));
    }
    
public function ask(Request $request)
{

        $request->validate([
            'persona' => 'required|string',

        ]);

        $persona = $request->persona;
        $course = $request->course;
        $material = $request->material;
        $message = $request->message;
     $user_id = auth()->user()->id;
        $fullPrompt = "Persona: {$persona}\n"
                    . ($course ? "Course: {$course}\n" : "")
                    . ($material ? "Relevant Material: {$material}\n" : "")
                    . "Question: {$message}";

        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'Gemini API key missing.'], 500);
        }

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$apiKey}", [
            "contents" => [
                ["parts" => [["text" => $fullPrompt]]]
            ]
        ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Gemini API error',
                'details' => $response->body()
            ], 500);
        }

        $aiTextRaw = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Keine Antwort erhalten.';

    $aiText = preg_replace('/(\*\*|\*|__|_)(.*?)\1/', '$2', $aiTextRaw);
        
            $aiText = str_replace('*', '', $aiText);


$chat = new AiChatHistory();
$chat->user_id = $user_id;
$chat->persona = $persona;
$chat->course = $course;
$chat->material = $material;
$chat->user_message = $message;
$chat->ai_response = $aiText;
$chat->save();

        


        return response()->json([
            'response' => nl2br($aiText)
        ]);

}


    
}
