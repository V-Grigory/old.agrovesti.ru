<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rubrik extends Model
{
    public $timestamps = false;
    protected $fillable = ['parent_id', 'name_ru', 'name_en', 'order',
			'on_main', 'position_number', 'template_number', 'icon_number',
        'target', 'params'];

    protected $casts = [
        'params' => 'array'
    ];

    public function setNameEnAttribute($value) {
        $this->attributes['name_en'] = Str::slug(
            mb_substr($this->name_ru,0,40)."="
						.\Carbon\Carbon::now()->format('dmyHi'), '-'
        );
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent() {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }

}
