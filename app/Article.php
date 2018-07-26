<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Str;

class Article extends Model
{

    public function rubriks()
    {
        return $this->belongsToMany('App\Rubrik');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

}
