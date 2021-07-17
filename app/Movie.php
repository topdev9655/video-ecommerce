<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'year',
        'release_date',
        'duration',
        'region',
        'language',
        'category',
        'genres',
        'directors',
        'writers',
        'cast',
        'poster',
        'cover',
        'plot',
        'summary',
        'movie_link',
    ];
}
