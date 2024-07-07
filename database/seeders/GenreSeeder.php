<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                ]);

                Translation::firstOrCreate([
                    'language' => $language,
                    'name' => $genre['name'],
                    'translatable_type' => Genre::class,
                    'translatable_id' => $newGenre->id
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
