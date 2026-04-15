<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function generateText($prompt)
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key=" . $this->apiKey;

        $data = [
            "contents" => [
                ["parts" => [["text" => $prompt]]]
            ]
        ];

        $response = Http::post($url, $data);

        if ($response->failed()) {
            return "Error: " . $response->body();
        }

        return $response->json();
    }
}
