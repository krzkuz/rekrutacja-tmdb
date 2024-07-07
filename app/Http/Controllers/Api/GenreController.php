<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    public function index(): JsonResponse
    {
        $genres = Genre::where('language', 'en')
            ->get();

        return response()->json($genres);
    }

    public function indexPl(): JsonResponse
    {
        $genres = Genre::where('language', 'pl')
            ->get();

        return response()->json($genres);
    }

    public function indexDe(): JsonResponse
    {
        $genres = Genre::where('language', 'de')
            ->get();

        return response()->json($genres);
    }
}
