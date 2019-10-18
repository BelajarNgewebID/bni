<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = ['user_id','class_id','nominal','status'];
    
    public function kelas() {
        return $this->belongsTo('App\Kelas', 'class_id');
    }
}
