<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use App\Models\TvShow;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class EpisodeController extends Controller
{
    public function index(TvShow $tvShow, Season $season)
    {
        $perPage = Request::input('perPage') ?: 5;

        return Inertia::render('TvShows/Seasons/Episodes/Index', [
            'episodes' => Episode::query()
                ->where('season_id', $season->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage']),
            'tvShow' => $tvShow,
            'season' => $season
        ]);
    }

    public function store(TvShow $tvShow, Season $season)
    {
        $episode = $season->episodes()->where('episode_number', Request::input('episodeNumber'))->exists();
        if ($episode) {
            return Redirect::back()->with('flash.banner', 'Episode Exists.');
        }
        $tmdb_episode = Http::asJson()->get(config('services.tmdb.endpoint') . 'tv/' . $tvShow->tmdb_id . '/season/' . $season->season_number . '/episode/'. Request::input('episodeNumber') . '?api_key=' . config('services.tmdb.secret') . '&language=en-US');

        if ($tmdb_episode->successful()) {
            Episode::create([
                'season_id' => $season->id,
                'tmdb_id' => $tmdb_episode['id'],
                'name'    => $tmdb_episode['name'],
                'episode_number' => $tmdb_episode['episode_number'],
                'overview'  => $tmdb_episode['overview'],
            ]);
            return Redirect::back()->with('flash.banner', 'Episode created.');
        } else {
            return Redirect::back()->with('flash.banner', 'Api error.');
        }    
    }

    public function edit(TvShow $tvShow, Season $season, Episode $episode)
    {
        return Inertia::render('TvShows/Seasons/Episodes/Edit', [
            'tvShow' => $tvShow,
            'season' => $season,
            'episode' => $episode
        ]);
    }

    public function update(TvShow $tvShow, Season $season, Episode $episode)
    {
        $validated = Request::validate([
            'name'    => 'required',
            'overview' => 'required',
            'is_public' => 'required'
        ]);
        $episode->update($validated);
        return Redirect::route('admin.episodes.index', [$tvShow->id, $season->id])->with('flash.banner', 'Episode updated.');
 
    }

    public function destroy(TvShow $tvShow, Season $season, Episode $episode)
    {
        $episode->delete();
        return Redirect::route('admin.episodes.index', [$tvShow->id, $season->id])->with('flash.banner', 'Episode deleted.')->with('flash.bannerStyle', 'danger');
    }
}
