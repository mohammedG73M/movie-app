<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function the_main_page_shows_correct_info(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular'=> $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing'=> $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list'=> $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');

        $response->assertSee('Action, Science Fiction, Horror ');

        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function the_movie_page_shows_the_correct_info(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
        ]);

        $response = $this->get(route('movies.show', 12345));
        $response->assertSee('Fake Jumanji');
        $response->assertSee('Jeanne McCarthy');
        $response->assertSee('Casting Director');
        $response->assertSee('Dwayne Johnson');
    }

    private function fakePopularMovies(){
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/7ZO9yoEU2fAHKhmJWfAc2QIPWJg.jpg",
                    "genre_ids" => [
                        28,
                        878,
                        27,
                    ],
                    "id" => 766507,
                    "original_language" => "en",
                    "original_title" => "Pray",
                    "overview" => "When danger threatens her camp, the fierce and highly skilled Comanche warrior Naru sets out to protect her people. But the prey she stalks turns out to be a highly evolved alien predator with a technically advanced arsenal.",
                    "popularity" => 10508.503,
                    "poster_path" => "/ujr5pztc1oitbe7ViMUOilFaJ7s.jpg",
                    "release_date" => "2022-08-02",
                    "title" => "Fake Movie",
                    "video" => false,
                    "vote_average" => 8.1,
                    "vote_count" => 2592,
                ],
            ],
        ], 200);
    }
    private function fakeNowPlayingMovies()
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/p1F51Lvj3sMopG948F5HsBbl43C.jpg",
                    "genre_ids" => [
                        28,
                        12,
                        14,
                    ],
                    "id" => 616037,
                    "original_language" => "en",
                    "original_title" => "Thor: Love and Thunder",
                    "overview" => "After his retirement is interrupted by Gorr the God Butcher, a galactic killer who seeks the extinction of the gods, Thor enlists the help of King Valkyrie, Korg, and ex-girlfriend Jane Foster, who now inexplicably wields Mjolnir as the Mighty Thor. Together they embark upon a harrowing cosmic adventure to uncover the mystery of the God Butcher’s vengeance and stop him before it’s too late.",
                    "popularity" => 6380.524,
                    "poster_path" => "/pIkRyD18kl4FhoCNQuWxWu5cBLM.jpg",
                    "release_date" => "2022-07-06",
                    "title" => "Now Playing Fake Movie",
                    "video" => false,
                    "vote_average" => 6.8,
                    "vote_count" => 1898,
                ],
            ],
        ], 200);
    }
    private function fakeGenres(){
        return Http::response([
            'genres' => [
                [
                    "id" => 28,
                    "name" => "Action",
                ],
                [
                    "id" => 12,
                    "name" => "Adventure",
                ],
                [
                    "id" => 16,
                    "name" => "Animation",
                ],
                [
                    "id" => 35,
                    "name" => "Comedy",
                ],
                [
                    "id" => 80,
                    "name" => "Crime",
                ],
                [
                    "id" => 99,
                    "name" => "Documentary",
                ],
                [
                    "id" => 18,
                    "name" => "Drama",
                ],
                [
                    "id" => 10751,
                    "name" => "Family",
                ],
                [
                    "id" => 14,
                    "name" => "Fantasy",
                ],
                [
                    "id" => 36,
                    "name" => "History",
                ],
                [
                    "id" => 27,
                    "name" => "Horror",
                ],
                [
                    "id" => 10402,
                    "name" => "Music",
                ],
                [
                    "id" => 9648,
                    "name" => "Mystery",
                ],
                [
                    "id" => 10749,
                    "name" => "Romance",
                ],
                [
                    "id" => 878,
                    "name" => "Science Fiction",
                ],
                [
                    "id" => 10770,
                    "name" => "TV Movie",
                ],
                [
                    "id" => 53,
                    "name" => "Thriller",
                ],
                [
                    "id" => 10752,
                    "name" => "War",
                ],
                [
                    "id" => 37,
                    "name" => "Western",
                ],
            ],
        ], 200);
    }
    private function fakeSingleMovie(){
        return Http::response([
            "adult" => false,
            "backdrop_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
            "genres" => [
                ["id" => 28, "name" => "Action"],
                ["id" => 12, "name" => "Adventure"],
                ["id" => 35, "name" => "Comedy"],
                ["id" => 14, "name" => "Fantasy"],
            ],
            "homepage" => "http://jumanjimovie.com",
            "id" => 12345,
            "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored.",
            "poster_path" => "/bB42KDdfWkOvmzmYkmK58ZlCa9P.jpg",
            "release_date" => "2019-12-04",
            "runtime" => 123,
            "title" => "Fake Jumanji: The Next Level",
            "vote_average" => 6.8,
            "credits" => [
                "cast" => [
                    [
                        "cast_id" => 2,
                        "character" => "Dr. Smolder Bravestone",
                        "credit_id" => "5aac3960c3a36846ea005147",
                        "gender" => 2,
                        "id" => 18918,
                        "name" => "Dwayne Johnson",
                        "order" => 0,
                        "profile_path" => "/kuqFzlYMc2IrsOyPznMd1FroeGq.jpg",
                    ]
                ],
                "crew" => [
                    [
                        "credit_id" => "5d51d4ff18b75100174608d8",
                        "department" => "Production",
                        "gender" => 1,
                        "id" => 546,
                        "job" => "Casting Director",
                        "name" => "Jeanne McCarthy",
                        "profile_path" => null,
                    ]
                ]
            ],
            "videos" => [
                "results" => [
                    [
                        "id" => "5d1a1a9b30aa3163c6c5fe57",
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "key" => "rBxcF-r9Ibs",
                        "name" => "JUMANJI: THE NEXT LEVEL - Official Trailer (HD)",
                        "site" => "YouTube",
                        "size" => 1080,
                        "type" => "Trailer",
                    ]
                ]
            ],
            "images" => [
                "backdrops" => [
                    [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
                        "height" => 2160,
                        "iso_639_1" => null,
                        "vote_average" => 5.388,
                        "vote_count" => 4,
                        "width" => 3840,
                    ]
                ],
                "posters" => [
                    [

                    ]
                ]
            ]
        ], 200);
    }
}
