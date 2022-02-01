<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Episode;
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
        # code...
    }
    public function seasonShow(TvShow $tvShow, Season $season)
    {
        # code...
    }

    public function showEpisode(Episode $episode)
    {
        # code...
    }

}
