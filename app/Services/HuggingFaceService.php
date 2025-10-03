<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HuggingFaceService {
    protected string $baseUrl = 'https://api-inference.huggingface.co/models/';
    protected string $apiKey;

    public function __construct() {
        $this->apiKey = config('services.huggingface.key');
    }

    public function query(string $model, array $payload) {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}"
        ])->post($this->baseUrl.$model, $payload);

        return $response->json();
    }
};