<?php

namespace App\Services;

use GuzzleHttp\Client;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;

class ChatGPTService
{
    protected $client;
    
    protected $apiKey;

    protected $apiURL;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENAI_API_KEY');
        $this->apiURL = env('GPT_API_URL');
    }
    
    public function chat(string $message)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post($this->apiURL, [
            'model' => 'gpt-3.5-turbo',  // Hoặc gpt-4 nếu bạn có quyền truy cập
            'messages' => [
                ['role' => 'system', 'content' => $message],
                // ['role' => 'user', 'content' => 'English answers only']
            ],
            'max_tokens' => 100,
        ]);

        $body = json_decode($response->getBody()->getContents(), true);
        return $body['choices'][0]['message']['content'] ?? 'No response';
    }
}