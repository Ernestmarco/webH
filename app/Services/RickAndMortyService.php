<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RickAndMortyService
{
    protected string $baseUrl = 'https://rickandmortyapi.com/api';

    /**
     * Obtiene la lista paginada de personajes.
     */
    public function getCharacters(int $page = 1): ?array
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/character", [
                'page' => $page,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning("Rick and Morty API respondió con estado: {$response->status()}");
            return null;
        } catch (\Exception $e) {
            Log::error("Error al conectar con la API de Rick and Morty: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * Obtiene un personaje individual por su ID.
     */
    public function getCharacter(int $id): ?array
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/character/{$id}");

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning("Rick and Morty API respondió con estado: {$response->status()} para el personaje {$id}");
            return null;
        } catch (\Exception $e) {
            Log::error("Error al obtener personaje {$id}: {$e->getMessage()}");
            return null;
        }
    }
}
