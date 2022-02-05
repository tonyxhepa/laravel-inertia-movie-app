<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CastController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/Casts/Index', [
            'casts' => Cast::orderBy('updated_at', 'desc')->paginate(12)
        ]);
    }

    public function show(Cast $cast)
    {
        $movies = $cast->movies;

        return Inertia::render('Frontend/Casts/Show', [
            'cast' => $cast,
            'movies' => $movies,
        ]);
    }
}
