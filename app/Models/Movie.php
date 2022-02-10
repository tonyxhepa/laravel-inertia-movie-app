<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Movie extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'title',
        'runtime',
        'release_date',
        'lang',
        'rating',
        'overview',
        'poster_path',
        'video_format',
        'is_public',
        'backdrop_path',
        'slug'
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('movies.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }

    public function trailers()
    {
        return $this->morphMany(TrailerUrl::class, 'trailerable');
    }

    public function downloads()
    {
        return $this->morphMany(Download::class, 'downloadable');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function casts()
    {
        return $this->belongsToMany(Cast::class, 'cast_movie');
    }
}
