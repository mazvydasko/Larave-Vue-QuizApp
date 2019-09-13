<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
