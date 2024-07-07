<?php

namespace App\Http\Controllers\Api;

use App\Models\Serie;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SerieController extends Controller
{
    public function index(string $language): JsonResponse
    {
        $series = Serie::with(['translates' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->get();

        return response()->json($series);
    }

    public function show(string $language, int $id): JsonResponse
    {
        $serie = Serie::with(['translates' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->find($id);

        return response()->json($serie);
    }
}
