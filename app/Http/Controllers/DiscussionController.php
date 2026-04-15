<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;
use App\Models\DiscussionTopic;

class DiscussionController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function storeTopic(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
    
        $topic = DiscussionTopic::create([
            'title' => $request->title,
            'user_id' => auth()->id()
        ]);
    
        return response()->json($topic);
    }
    
    public function getTopics()
    {
        return response()->json(DiscussionTopic::where('user_id', auth()->id())->get());
    }
    

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'topic_id' => 'required|exists:discussion_topics,id'
        ]);

        $userMessage = $request->input('message');
        $topic = DiscussionTopic::find($request->topic_id);

        // 🔹 AI Prompt
        $aiPrompt = "You are discussing the topic '{$topic->title}'. Answer professionally:\n\n" . $userMessage;
        $aiResponse = $this->geminiService->generateText($aiPrompt);
        $botReply = $aiResponse['candidates'][0]['content']['parts'][0]['text'] ?? "AI couldn't generate a response.";

        return response()->json([
            'user_message' => $userMessage,
            'bot_reply' => $botReply
        ]);
    }

    public function deleteTopic($id)
    {
        $topic = DiscussionTopic::find($id);
    
        if (!$topic) {
            return response()->json(['message' => __('messages.topic')], 404);
        }
    
        $topic->delete();
        $topics = DiscussionTopic::where('user_id',auth()->id())->get();
    
        return response()->json([
            'message' => 'Topic deleted successfully!',
            'topics'  => $topics
        ]);
    }
    

}
