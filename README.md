# TMDB API

## Instalacja

Do działania progamu oprócz standardowej instalacji, w pliku .env trzeba dodać linię kodu z kluczem API TMDB:
TMDB_API_KEY = {api_key}

## Migracje i seedowanie bazy danych

By to zrobić wystarczy wpisać komendę 'php artisan TMDBData'

## Endpointy

### Movies

-   api/{language}/movies - lista wszystkich filmow, tłumaczenie w zależności od parametru language (możliwe pl, de, en)
-   api/{language}/movies/{id} - wybrany film (parametr id) z odpowiednim tlumaczeniem (parametr language)

### Series

-   api/{language}/series - lista wszystkich seriali, tłumaczenie w zależności od parametru language (możliwe pl, de, en)
-   api/{language}/series/{id} - wybrany serial (parametr id) z odpowiednim tlumaczeniem (parametr language)

### Genres

-   api/{language}/genres - lista wszystkich gatunków, tłumaczenie w zależności od parametru language (możliwe pl, de, en)
-   api/{language}/series-by-genre/{id} - lista wszystkich seriali które należą do danego gatunku (parametr id), tłumaczone na wybrany język (parametr language)
-   api/{language}/movies-by-genre/{id} - lista wszystkich filmów które należą do danego gatunku (parametr id), tłumaczone na wybrany język (parametr language)
