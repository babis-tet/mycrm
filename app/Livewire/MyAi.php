<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI;

class MyAi extends Component
{
    public $question = ''; // Stores the user's input
    public $chatHistory = []; // Stores chat history
    public $isLoading = false; // Tracks loading state

    public function askOpenAi()
    {
        if (trim($this->question) === '') {
            return;
        }

        $this->isLoading = true; // Start loading

        // Add the user's question to the chat history
        $this->chatHistory[] = [
            'role' => 'user',
            'content' => $this->question,
        ];

        try {
            // Call OpenAI API with model 'gpt-4'
            $client = OpenAI::client(env('OPENAI_API_KEY'));
            $response = $client->chat()->create([
                'model' => 'gpt-4', // Change to gpt-4 here
                'messages' => $this->formatChatHistory(),
            ]);

            // Add AI's response to the chat history
            $this->chatHistory[] = [
                'role' => 'assistant',
                'content' => $response['choices'][0]['message']['content'] ?? 'No response from OpenAI.',
            ];
        } catch (\Exception $e) {
            // Handle API errors
            $this->chatHistory[] = [
                'role' => 'assistant',
                'content' => 'An error occurred. Please try again.',
            ];
        } finally {
            $this->isLoading = false; // Stop loading
            $this->question = ''; // Clear the question input
        }
    }

    public function formatChatHistory()
    {
        // Format chat history for OpenAI's API
        $formatted = [];
        foreach ($this->chatHistory as $chat) {
            $formatted[] = [
                'role' => $chat['role'],
                'content' => $chat['content'],
            ];
        }

        return $formatted;
    }

    public function render()
    {
        return view('livewire.my-ai');
    }
}
