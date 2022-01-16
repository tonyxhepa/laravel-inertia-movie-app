<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CastController extends Controller
{
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;

        return Inertia::render('Casts/Index', [
            'casts' => Cast::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage'])
        ]);
    }

    public function edit(Cast $cast)
    {
        return Inertia::render('Casts/Edit', ['cast' => $cast]);
    }

    public function store()
    {
        $cast = Cast::where('tmdb_id', Request::input('castTMDBId'))->first();
        if ($cast) {
            return Redirect::back()->with('flash.banner', 'Cast Exists.');
        }

        $tmdb_cast = Http::asJson()->get(config('services.tmdb.endpoint').'person/' . Request::input('castTMDBId') . '?api_key='. config('services.tmdb.secret') .'&language=en-US');
        if ($tmdb_cast->successful()) {
            Cast::create([
                'tmdb_id' => $tmdb_cast['id'],
                'name'    => $tmdb_cast['name'],
                'slug'    => Str::slug($tmdb_cast['name']),
                'poster_path' => $tmdb_cast['profile_path']
            ]); 
            return Redirect::back()->with('flash.banner', 'Cast created.');
        } else {
            return Redirect::back()->with('flash.banner', 'Api error.');
        }                
    }

    public function update(Cast $cast)
    {
        $validated = Request::validate([
            'name' => 'required',
            'poster_path' => 'required'
        ]);
        $cast->update($validated);
        return Redirect::route('admin.casts.index')->with('flash.banner', 'Cast Updated.');
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();
        return Redirect::back()->with('flash.banner', 'Cast Deleted.');
    }
}
