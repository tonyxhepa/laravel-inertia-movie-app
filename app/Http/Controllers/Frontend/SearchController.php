<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $data = (new Search())
            ->registerModel(Movie::class, 'title')
            ->registerModel(TvShow::class, 'name')
            ->registerModel(Episode::class, 'name')
            ->search($request->search);

        return response()->json($data);
    }
}
