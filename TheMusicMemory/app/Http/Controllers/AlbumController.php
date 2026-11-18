<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Log;
use RuntimeException;

use App\Services\CatalogClient;

class AlbumController extends Controller
{

    public function __construct(private readonly CatalogClient $spotify)
    {
    }
    public function searchArtists(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
        ]);

        return $this->respond(fn() => $this->spotify->searchArtists($data['name']));
    }

    /**
     * Centralize error management
     * @param Closure $callback
     * @return JsonResponse
     */
    private function respond(Closure $callback): JsonResponse
    {
        try {
            return response()->json(['data' => $callback()]);
        } catch (HttpClientException | RuntimeException $e) {
            // On logue le détail, mais on ne renvoie jamais le message brut (peut contenir des infos d'auth).
            Log::warning('Spotify error', ['class' => $e::class, 'message' => $e->getMessage()]);

            return response()->json(
                ['error' => 'Service Spotify momentanément indisponible.'],
                502
            );
        }
    }
}
