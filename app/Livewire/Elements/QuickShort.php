<?php

namespace App\Livewire\Elements;

use App\Models\ShortLink;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class QuickShort extends Component
{
    public $url;

    public $errorMessage;
    public $shortenedUrls = [];

    public function mount()
    {
        // Fetch all shortened URLs stored in cookies and deserialize them
        $this->shortenedUrls = json_decode(Cookie::get('shortened_urls', '[]'), true);
    }

    public function shortLink()
    {
        // Validate the URL
        $validator = Validator::make(['url' => $this->url], [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            $this->errorMessage = 'Invalid URL';

            return;
        }

        // Sanitize the URL
        $this->url = filter_var($this->url, FILTER_SANITIZE_URL);

        $shortenedUrl = Str::random(6);

        // Update the shortened URLs array and serialize it
        $this->shortenedUrls[] = url('/') . '/' . $shortenedUrl . '-';
        Cookie::queue('shortened_urls', json_encode($this->shortenedUrls), 60 * 24 * 90); // 3 months

        $this->errorMessage = null;

        // Store the shortened URL in the database
        ShortLink::create([
            'user_id' => auth()->user()->id ?? null,
            'original_url' => $this->url,
            'shortened_url' => $shortenedUrl,
            'open' => 0,
            'is_active' => true,
            'is_premium' => false,
        ]);
    }

    public function render()
    {
        return view('livewire.elements.quick-short', ['shortenedUrls' => $this->shortenedUrls]);
    }
}
