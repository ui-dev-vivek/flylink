<?php

namespace App\Livewire\Elements;

use App\Models\ShortLink;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class QuickShort extends Component
{ public $url;
    public $errorMessage;
    public $shortenedUrls = [];

    public function mount()
    {
        try {
            // Fetch all shortened URLs stored in cookies and deserialize them
            $this->shortenedUrls = json_decode(Cookie::get('shortened_urls', '[]'), true);
            
            
            if (auth()->check()) {
                $userId = auth()->id();
                foreach ($this->shortenedUrls as $shortenedUrl) {
                    $parts = explode('/', $shortenedUrl);
                    $urlID = str_replace('-', '', end($parts));
                    ShortLink::where('shortened_url', $urlID)
                        ->update(['user_id' => $userId]);
                }
                // Clear the shortened URLs cookie after updates
                Cookie::queue(Cookie::forget('shortened_urls'));
            }
        } catch (Exception $e) {
            Log::error("Error updating shortened URLs: " . $e->getMessage());
            $this->errorMessage = 'There was an error updating the shortened URLs. Please try again later.';
        }
    }

    public function shortLink()
    {
        try {
            // Validate the URL
            $validator = Validator::make(['url' => $this->url], [
                'url' => 'required|url',
            ]);

            if ($validator->fails()) {
                $this->errorMessage = 'Invalid URL';
                return;
            }
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);

            do {
                $shortenedUrl = Str::random(6);
            } while (ShortLink::where('shortened_url', $shortenedUrl)->exists());
    
            $this->shortenedUrls[] = url('/') . '/' . $shortenedUrl . '-';
            Cookie::queue('shortened_urls', json_encode($this->shortenedUrls), 60 * 24 * 90);

            $this->errorMessage = null;
            ShortLink::create([
                'user_id' => auth()->user()->id ?? null,
                'original_url' => $this->url,
                'shortened_url' => $shortenedUrl,
                'open' => 0,
                'is_active' => true,
                'is_premium' => false,
            ]);
        } catch (Exception $e) {
            Log::error("Error creating short link: " . $e->getMessage());
            $this->errorMessage = 'There was an error creating the short link. Please try again later.';
        }
    }

    public function render()
    {
        return view('livewire.elements.quick-short', [
            'shortenedUrls' => $this->shortenedUrls,
            'errorMessage' => $this->errorMessage
        ]);
    }
}
