<?php

namespace App\Http\Controllers;

use App\Services\RickAndMortyService;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function __construct(
        protected RickAndMortyService $rickAndMortyService
    ) {}

    /**
     * Muestra la lista paginada de personajes.
     */
    public function index(Request $request)
    {
        $page = (int) $request->query('page', 1);
        $data = $this->rickAndMortyService->getCharacters($page);

        if (!$data) {
            return view('index', [
                'characters' => [],
                'info'       => null,
                'currentPage' => $page,
            ]);
        }

        return view('index', [
            'characters'  => $data['results'] ?? [],
            'info'        => $data['info'] ?? null,
            'currentPage' => $page,
        ]);
    }

    /**
     * Muestra el detalle de un personaje.
     */
    public function show(int $id)
    {
        $character = $this->rickAndMortyService->getCharacter($id);

        if (!$character) {
            abort(404, 'Personaje no encontrado.');
        }

        return view('show', compact('character'));
    }
}
