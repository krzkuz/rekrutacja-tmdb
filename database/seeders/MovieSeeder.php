<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $apiKey = env('TMDB_API_KEY');
        $languages = ['en', 'de', 'pl'];

        foreach ($languages as $language) {
            $movies = $this->fetchMovies($apiKey, $language);

            foreach (array_slice($movies, 0, 50) as $movie) {
                $newMovie = Movie::firstOrCreate([
                    'tmdb_id' => $movie['id']
                ]);


                Translation::firstOrCreate([
                    'language' => $language,
                    'name' => $movie['title'],
                    'translatable_type' => Movie::class,
                    'translatable_id' => $newMovie->id,
                    'overview' => $movie['overview']
                ]);


                //get genres associated with movie and attach it to this Movie
                $genreIds = $movie['genre_ids'];
                $genres = Genre::whereIn('tmdb_id', $genreIds)
                    ->get();

                $newMovie->genres()->attach($genres);
            }
        }
    }

    private function fetchMovies(string $apiKey, string $language): array
    {
        $allMovies = [];
        for ($page = 1; $page <= 3; $page++) {
            $response = Http::get("https://api.themoviedb.org/3/movie/popular?api_key=$apiKey&language=$language&page=$page");
            $movies = $response->json()['results'];
            $allMovies = array_merge($allMovies, $movies);
        }
        return $allMovies;
    }
}
