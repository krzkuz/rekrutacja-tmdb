<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\SerieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//movies
Route::get('/{language}/movies', [MovieController::class, 'index']);
Route::get('/{language}/movies/{id}', [MovieController::class, 'show']);

//series
Route::get('/{language}/series', [SerieController::class, 'index']);
Route::get('/{language}/series/{id}', [SerieController::class, 'show']);

//genres
Route::get('/{language}/genres', [GenreController::class, 'index']);
Route::get('/{language}/series-by-genre/{id}', [GenreController::class, 'seriesByGenre']);
Route::get('/{language}/movies-by-genre/{id}', [GenreController::class, 'moviesByGenre']);
