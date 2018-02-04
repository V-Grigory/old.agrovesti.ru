<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rubrik extends Model
{
    public $timestamps = false;
    protected $fillable = ['parent_id', 'name_ru', 'name_en', 'order'];

    public function setName_enAttribute($value) {
        $this->attributes['name_en'] = Str::slug(mb_substr($this->name_ru,0,40)."=". \Carbon\Carbon::now()->format('dmyHi'), '-');
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id');
    }
}
