<?php

namespace App\Services;

use App\Models\Setting;

class SentimentService
{
    private string $token;
    private string $model;
    private string $url = 'https://router.huggingface.co/hf-inference/models/';

    public function __construct() {
        $huggingfaceToken = Setting::where('name', 'huggingface-token')->first();
        $this->token = $huggingfaceToken->body;
        $huggingfaceModel = Setting::where('name', 'huggingface-model')->first();
        $this->model = $huggingfaceModel->body;
    }

    public function analyze(string $text)
    {
        $endpoint = $this->model;
        $headers = [];
        $body = json_encode(['inputs' => $text]);
        $response = SentimentService::exec('POST', $endpoint, $body, $headers);
        $response = json_decode($response);
        $melhor = collect($response[0])->sortByDesc('score')->first();
        
        return $melhor;
    }

    public function exec($method, $endpoint, $body = null, $headers = [])
    {
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$this->token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.$endpoint);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            $error_message = curl_error($ch);
            // Handle the error
            echo "Error: " . $error_message;
        }

        // Close the CURL session
        curl_close($ch);
        
        return $response;
    }
}