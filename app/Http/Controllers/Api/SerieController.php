<?php

namespace App\Http\Controllers\Api;

use App\Models\Serie;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SerieController extends Controller
{
    public function index(): JsonResponse
    {
        $series = Serie::where('language', 'en')
            ->get();

        return response()->json($series);
    }

    public function indexPl(): JsonResponse
    {
        $series = Serie::where('language', 'pl')
            ->get();

        return response()->json($series);
    }

    public function indexDe(): JsonResponse
    {
        $series = Serie::where('language', 'de')
            ->get();

        return response()->json($series);
    }
}
