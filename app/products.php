<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table= "products";

    public function coments()
    {
        return $this->hasMany('App\coments');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
