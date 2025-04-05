<?php

namespace App\Services;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class UrlShortenerService
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function encode(string $originalUrl): string
    {
        // Check if this URL has already been shortened
        $existingCode = cache()->get('url:' . md5($originalUrl));

        if ($existingCode) {
            return url($existingCode);
        }

        $code = substr(md5($originalUrl . microtime()), 0, 6);

        cache()->put($code, $originalUrl, now()->addMinutes(60));
        /**
         * Cache the original URL hash as a key pointing to the generated code.
         * This allows quick checks to avoid regenerating a new short code for the same URL.
         */
        cache()->put('url:' . md5($originalUrl), $code, now()->addMinutes(60));

        return url($code);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function decode(string $shortUrl): ?string
    {
        $code = trim(parse_url($shortUrl, PHP_URL_PATH), '/');

        return cache()->get($code) ?? null;
    }
}
