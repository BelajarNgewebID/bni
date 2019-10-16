<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'class';
    protected $fillable = ['user_id','title','description','cover','tag'];

    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function learn() {
        $this->hasMany('App\Learn', 'class_id');
    }
}
