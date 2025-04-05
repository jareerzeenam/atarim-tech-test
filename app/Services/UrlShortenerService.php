<?php

namespace App\Services;

class UrlShortenerService
{

    public function encode(string $originalUrl): string
    {
        $code = substr(md5($originalUrl . microtime()), 0, 6);

        return url($code);
    }

    public function decode(string $shortUrl): ?string
    {
    //
    }
}
