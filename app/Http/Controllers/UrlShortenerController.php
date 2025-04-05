<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;

class UrlShortenerController extends Controller
{
    protected UrlShortenerService $shortener;

    public function __construct(UrlShortenerService $shortener)
    {
        $this->shortener = $shortener;
    }

    public function encode(UrlRequest $request)
    {

        $shortUrl = $this->shortener->encode($request->input('url'));

        return response()->json(['short_url' => $shortUrl]);
    }

    public function decode(UrlRequest $request)
    {
        $originalUrl = $this->shortener->decode($request->input('url'));

        if (!$originalUrl) {
            return response()->json(['error' => 'URL not found'], 404);
        }

        return response()->json(['original_url' => $originalUrl]);

    }
}
