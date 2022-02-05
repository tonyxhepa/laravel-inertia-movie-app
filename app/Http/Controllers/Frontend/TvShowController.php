<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Season;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TvShowController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/TvShows/Index', [
            'tvShows' => TvShow::orderBy('created_at', 'desc')->paginate(12)
        ]);
    }

    public function show(TvShow $tvShow)
    {
        $latests = Movie::orderBy('created_at', 'desc')->take(9)->get();

        return Inertia::render('Frontend/TvShows/Show', [
            'tvShow' => $tvShow,
            'seasons' => $tvShow->seasons,
            'latests' => $latests
        ]);
    }
    public function seasonShow(TvShow $tvShow, Season $season)
    {
        $latests = Movie::orderBy('created_at', 'desc')->take(9)->get();

        return Inertia::render('Frontend/TvShows/Seasons/Show', [
            'tvShow' => $tvShow,
            'season' => $season,
            'episodes' => $season->episodes,
            'latests' => $latests
        ]);

    }

    public function showEpisode(Episode $episode)
    {
        $latests = Episode::latest()->take(12)->get();
        return Inertia::render('Frontend/Episodes/Show', [
            'episode' => $episode,
            'season' => $episode->season,
            'latests' => $latests
        ]);
    }

}
