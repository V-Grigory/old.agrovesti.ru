<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rubrik extends Model
{
    public $timestamps = false;
    protected $fillable = ['parent_id', 'name_ru', 'name_en'];

    public function setNameEnAttribute($value) {
        $this->attributes['name_en'] = Str::slug(mb_substr($this->name_ru,0,40)."=".\Carbon\Carbon::now()->format('dmyHi'), '-');
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }

//    public function on_main_articles() {
//        return $this->articles()->where('on_main','=', 1);
//    }
}
