<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coments extends Model
{
    protected $table= "coments";

    public function products()
    {
        return $this->belongsTo('App\products');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
