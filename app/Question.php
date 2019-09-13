<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function options() {
        return $this->hasMany('App\Options', 'question_id', 'id');
    }

    public function topic() {
        return $this->hasOne('App\Topic', 'id', 'topic_id');
    }
}
