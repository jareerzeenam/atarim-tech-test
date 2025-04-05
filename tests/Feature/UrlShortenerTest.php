<?php

use Illuminate\Support\Facades\Cache;

it('encodes a URL to a shortened URL', function () {
    $originalUrl = 'https://www.thisisalongdomain.com/with/some/parameters?and=here_too';

    $response = $this->postJson('/api/encode', ['url' => $originalUrl]);

    $response->assertStatus(200)->assertJsonStructure(['short_url']);

    $shortUrl = $response->json('short_url');

    expect($shortUrl)->toMatch('/http:\/\/(localhost|127.0.0.1)\/[a-zA-Z0-9]{6}/');
});

it('decodes a shortened URL to the original URL', function () {
    $originalUrl = 'https://www.thisisalongdomain.com/with/some/parameters?and=here_too';
    $code = substr(md5($originalUrl . microtime()), 0, 6);

    Cache::put($code, $originalUrl, now()->addMinutes(60));

    $shortUrl = url($code);

    $response = $this->postJson('/api/decode', ['url' => $shortUrl]);

    $response->assertStatus(200)->assertJson(['original_url' => $originalUrl]);
});

it('returns error when decoding an invalid URL', function () {

    $shortUrl = 'http://127.0.0.1/nonexistent-code';

    $response = $this->postJson('/api/decode', ['url' => $shortUrl]);

    $response->assertStatus(404)->assertJson(['error' => 'URL not found']);
});
