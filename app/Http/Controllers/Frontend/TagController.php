<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        return Inertia::render('Frontend/Tags/Index', [
            'tag' => $tag,
            'movies' => $tag->movies()->paginate(12)
        ]);
    }
}
