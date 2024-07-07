<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    public function index(string $language): JsonResponse
    {
        $genres = Genre::with(['translates' => function ($query) use ($language) {
            $query->select('id', 'name', 'language', 'translatable_id', 'translatable_type', 'created_at', 'updated_at')
                ->where('language', $language);
        }])->get();

        return response()->json($genres);
    }

    public function seriesByGenre(string $language, int $id): JsonResponse
    {
        $genre = Genre::with([
            'series.translates' => function ($query) use ($language) {
                $query->where('language', $language);
            },
            'translates' => function ($query) use ($language) {
                $query->where('language', $language);
            }
        ])->find($id);

        return response()->json($genre);
    }

    public function moviesByGenre(string $language, int $id): JsonResponse
    {
        $genre = Genre::with([
            'movies.translates' => function ($query) use ($language) {
                $query->where('language', $language);
            },
            'translates' => function ($query) use ($language) {
                $query->where('language', $language);
            }
        ])->find($id);

        return response()->json($genre);
    }
}
