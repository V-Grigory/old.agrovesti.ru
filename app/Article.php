<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    //protected $fillable = ['name_ru', 'name_en', 'article', 'image', 'on_main', 'need_pay'];

//    public function setNameEnAttribute($value) {
//        $this->attributes['name_en'] = Str::slug(mb_substr($this->name_ru,0,40)."=".\Carbon\Carbon::now()->format('dmyHi'), '-');
//    }
//
//    public function setImageAttribute($value) {
//        $this->attributes['image'] = 'image';
//    }
//
//    public function setOnMainAttribute($value) {
//        if(isset($this->image)) $tt = 1; else $tt = 0;
//        $this->attributes['on_main'] = $tt;
//    }

    public function rubriks()
    {
        return $this->belongsToMany('App\Rubrik');
    }
}
