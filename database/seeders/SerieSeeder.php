<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Serie;
use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class SerieSeeder extends Seeder
{
    public function run()
    {
        $apiKey = env('TMDB_API_KEY');
        $languages = ['en', 'de', 'pl'];

        foreach ($languages as $language) {
            $series = $this->fetchSeries($apiKey, $language);


            foreach (array_slice($series, 0, 50) as $serie) {
                $newSerie = Serie::create([
                    'tmdb_id' => $serie['id'],
                    'language' => $language,
                    'name' => $serie['name'],
                    'overview' => $serie['overview'],
                ]);

                //get genres associated with serie and attach it to this Serie
                $genreIds = $serie['genre_ids'];
                $genres = Genre::whereIn('tmdb_id', $genreIds)
                    ->get();

                $newSerie->genres()->attach($genres);
            }
        }
    }

    private function fetchSeries(string $apiKey, string $language): array
    {
        $allSeries = [];
        for ($page = 1; $page <= 3; $page++) {
            $response = Http::get("https://api.themoviedb.org/3/tv/popular?api_key=$apiKey&language=$language&page=$page");
            $serie = $response->json()['results'];
            $allSeries = array_merge($allSeries, $serie);
        }
        return $allSeries;
    }
}
