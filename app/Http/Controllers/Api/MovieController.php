<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index(string $language): JsonResponse
    {
        $movies = Movie::where('language', $language)
            ->get();

        return response()->json($movies);
    }

    public function show(int $id): JsonResponse
    {
        $movie = Movie::find($id);

        return response()->json($movie);
    }
}
