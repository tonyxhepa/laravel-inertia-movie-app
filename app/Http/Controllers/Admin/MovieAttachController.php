<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Movie;
use App\Models\Tag;
use App\Models\TrailerUrl;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class MovieAttachController extends Controller
{
    public function index(Movie $movie)
    {
        return Inertia::render('Movies/Attach', [
            'movie' => $movie,
            'trailers' => $movie->trailers,
            'casts' => Cast::all('id', 'name'),
            'tags' => Tag::all('id', 'tag_name'),
            'movieCasts' => $movie->casts,
            'movieTags' => $movie->tags
        ]);
    }

    public function addTrailer(Movie $movie)
    {
        $movie->trailers()->create(Request::validate([
            'name'    => 'required',
            'embed_html' => 'required'
        ]));
        return Redirect::back()->with('flash.banner', 'Trailer Added.');
    }

    public function destroyTrailer(TrailerUrl $trailerUrl)
    {
        $trailerUrl->delete();
        return Redirect::back()->with('flash.banner', 'Trailer deleted.');
    }

    public function addCast(Movie $movie)
    {
        $casts = Request::input('casts');
        $cast_ids = collect($casts)->pluck('id');
       $movie->casts()->sync($cast_ids);
        return Redirect::back()->with('flash.banner', 'Csats attached.');

    }
    public function addTag(Movie $movie)
    {
        $tags = Request::input('tags');
        $tag_ids = collect($tags)->pluck('id');
        $movie->tags()->sync($tag_ids);
        return Redirect::back()->with('flash.banner', 'Tags attached.');
    }
}
