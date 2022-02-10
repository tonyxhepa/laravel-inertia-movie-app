<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovieController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/Movies/Index', [
            'movies' => Movie::orderBy('created_at', 'desc')->with('genres')->paginate(4)
        ]);
    }

    public function show(Movie $movie)
    {
        $latests = Movie::orderBy('created_at', 'desc')->take(9)->get();

        return Inertia::render('Frontend/Movies/Show', [
            'movie' => $movie,
            'latests' => $latests,
            'movieGenres' => $movie->genres,
            'casts' => $movie->casts,
            'tags' => $movie->tags,
            'trailers' => $movie->trailers,
            'downloads' => $movie->downloads,
        ]);
    }
}
