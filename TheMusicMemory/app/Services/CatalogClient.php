<?php

namespace App\Services;

use App\Data\Album;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Summary of CatalogClient
 * All the route for the Catalogue API (here spotify)
 */
class CatalogClient
{
    private const API_URL = 'https://api.spotify.com/v1';
    private const TOKEN_URL = 'https://accounts.spotify.com/api/token';
    private const TOKEN_KEY = 'spotify:access_token';

    private string $clientId;
    private string $clientSecret;
    private string $market;
    private int $cacheTtl;

    public function __construct()
    {
        $this->clientId = (string) config('services.spotify.client_id');
        $this->clientSecret = (string) config('services.spotify.client_secret');
        $this->market = (string) config('services.spotify.market', 'CA');
        $this->cacheTtl = (int) config('services.spotify.cache_ttl', 3600); // 1 h : temp cache 
    }


    public function searchArtists(string $name, int $limit = 10): array
    {
        $limit = min(max($limit, 1), 10);
        $key = 'spotify:search-artist:' . md5(mb_strtolower($name)) . ":{$limit}:{$this->market}";

        return Cache::remember($key, $this->cacheTtl, function () use ($name, $limit) {
            $data = $this->get('/search', [
                'q' => $name,
                'type' => 'artist',
                'limit' => $limit,
                'market' => $this->market,
            ]);

            return collect($data['artists']['items'] ?? [])->map(fn(array $a) => [
                'id' => $a['id'],
                'name' => $a['name'],
                'genres' => $a['genres'] ?? [],
                'image' => $a['images'][0]['url'] ?? null, // the biggest to display
                'spotify_url' => $a['external_urls']['spotify'] ?? null,
            ])->all();
        });
    }

    /* 
    |---------------------------------------------------------------------
    |  Authentification and API access
    | ------------------------------------------------------------------ */
    private function requestToken(): string
    {
        $response = Http::asForm()
            ->withBasicAuth($this->clientId, $this->clientSecret)
            ->timeout(10)
            ->post(self::TOKEN_URL, ['grant_type' => 'client_credentials'])
            ->throw();

        $token = $response->json('access_token');

        if (!$token) {
            throw new RuntimeException('Spotify : token absent de la réponse.');
        }

        $ttl = max(60, (int) $response->json('expires_in', 3600) - 60); //token exprire before real time (60 s before)
        Cache::put(self::TOKEN_KEY, $token, $ttl);

        return $token;
    }
    private function getToken(): string
    {
        return Cache::get(self::TOKEN_KEY) ?? $this->requestToken();
    }

    private function get(string $path, array $query = [], bool $canRetry = true): array
    {
        $response = Http::withToken($this->getToken())
            ->acceptJson()
            ->timeout(15)
            ->get(self::API_URL . $path, $query);

        if ($canRetry && $response->status() === 401) {
            Cache::forget(self::TOKEN_KEY);

            return $this->get($path, $query, false);
        }

        if ($canRetry && $response->status() === 429) {
            sleep(min(10, max(1, (int) $response->header('Retry-After'))));

            return $this->get($path, $query, false);
        }

        return $response->throw()->json();
    }
}