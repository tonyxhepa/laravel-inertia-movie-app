<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Tags/Index', [
            'tags' => Tag::query()
                           ->when(Request::input('search'), function($query, $search) {
                               $query->where('tag_name', 'like', "%{$search}%");
                           })
                           ->paginate($perPage)
                           ->withQueryString(),
            'filters' => Request::only(['search', 'perPage'])               
        ]);
    }

    public function create()
    {
        return Inertia::render('Tags/Create');
    }
    public function store()
    {
        Tag::create([
            'tag_name' => Request::input('tagName'),
            'slug' => Str::slug(Request::input('tagName'))
        ]);

        return Redirect::route('admin.tags.index')->with('flash.banner', 'Tag Created.');

    }

    public function edit(Tag $tag)
    {
        return Inertia::render('Tags/Edit', [
            'tag' => $tag
        ]);
    }

    public function update(Tag $tag)
    {
        $tag->update([
            'tag_name' => Request::input('tagName'),
            'slug' => Str::slug(Request::input('tagName'))
        ]);

        return Redirect::route('admin.tags.index')->with('flash.banner', 'Tag updated.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return Redirect::route('admin.tags.index')->with('flash.banner', 'Tag deleted.')->with('flash.bannerStyle', 'danger');
    }
}
