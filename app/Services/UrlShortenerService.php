<?php

namespace App\Services;

class UrlShortenerService
{
    public function encode(string $originalUrl): string
    {
        $code = substr(md5($originalUrl . microtime()), 0, 6);
        cache()->put($code, $originalUrl, now()->addMinutes(60));

        return url($code);
    }

    public function decode(string $shortUrl): ?string
    {
        $code = trim(parse_url($shortUrl, PHP_URL_PATH), '/');

        return cache()->get($code) ?? null;
    }
}
