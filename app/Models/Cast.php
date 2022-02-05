<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cast extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id', 'name', 'slug', 'poster_path'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'cast_movie');
    }
}
