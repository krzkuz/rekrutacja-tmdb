<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $apiKey = env('TMDB_API_KEY');
        $languages = ['en', 'de', 'pl'];

        foreach ($languages as $language) {
            $genres = $this->fetchGenres($apiKey, $language);


            foreach ($genres as $genre) {
                $newGenre = Genre::firstOrCreate([
                    'tmdb_id' => $genre['id'],
                    'language' => $language,
                    'name' => $genre['name'],
                ]);
            }
        }
    }

    private function fetchGenres(string $apiKey, string $language): array
    {
        $response = Http::get("https://api.themoviedb.org/3/genre/tv/list?api_key=$apiKey&language=$language");
        $tvGenres = $response->json()['genres'];
        $response = Http::get("https://api.themoviedb.org/3/genre/movie/list?api_key=$apiKey&language=$language");
        $movieGenres = $response->json()['genres'];
        $allGenres = array_merge($tvGenres, $movieGenres,);

        return $allGenres;
    }
}
