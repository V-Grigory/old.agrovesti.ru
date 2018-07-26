<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

}
