<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GenreController extends Controller
{
    public function show(Genre $genre)
    {
        return Inertia::render('Frontend/Genres/Index', [
            'genre' => $genre,
            'movies' => $genre->movies()->paginate(12)
        ]);
    }
}
