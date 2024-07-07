<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index(string $language): JsonResponse
    {
        $movies = Movie::with(['translates' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->get();

        return response()->json($movies);
    }

    public function show(string $language, int $id): JsonResponse
    {
        $movie = Movie::with(['translates' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->find($id);

        return response()->json($movie);
    }
}
