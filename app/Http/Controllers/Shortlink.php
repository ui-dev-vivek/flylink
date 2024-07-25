<?php

namespace App\Http\Controllers;

use App\Models\ShortLink as ModelsShortLink;
use Illuminate\Http\Request;

class Shortlink extends Controller
{

    public function redirect($urlCode)
    {

        $link = ModelsShortLink::where('shortened_url', $urlCode)->firstOrFail();

        $link->increment('open');

        return redirect($link->original_url);
    }
}
