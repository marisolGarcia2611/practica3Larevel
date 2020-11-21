<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accounts extends Model
{
    protected $table= "accounts";


    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
