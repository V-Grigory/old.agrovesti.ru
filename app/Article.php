<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Str;

class Article extends Model
{

		protected $casts = [
			'params' => 'array'
		];

    public function rubriks()
    {
        return $this->belongsToMany('App\Rubrik');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

}
