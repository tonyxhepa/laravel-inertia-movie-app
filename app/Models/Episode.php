<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Episode extends Model implements Searchable
{
    use HasFactory;


    protected $fillable = ['tmdb_id', 'name', 'slug', 'overview', 'season_id', 'episode_number', 'is_public'];

    public function getSearchResult(): SearchResult
    {
        $url = route('episodes.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

}
