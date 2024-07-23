<?php

namespace App\Livewire\Elements;



use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class QuickShort extends Component
{
    public $url;
    public $shortenedUrl;
    public $errorMessage;

    public function shortLink()
    {
        // Validate the URL
        $validator = Validator::make(['url' => $this->url], [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            $this->errorMessage = 'Invalid URL';
            $this->shortenedUrl = null;
            return;
        }

        // Sanitize the URL
        $this->url = filter_var($this->url, FILTER_SANITIZE_URL);

        // Create a shortened URL (example logic, replace with actual URL shortening)
        $this->shortenedUrl = 'flyl.ink/' . Str::random(6);
        $this->errorMessage = null;
    }

    public function render()
    {
        return view('livewire.elements.quick-short');
    }
}
