<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learn extends Model
{
    protected $table = 'learn';
    protected $fillable = ['user_id','material_id','class_id','to_pay','status'];

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'class_id');
    }
    public function material() {
        return $this->belongsTo('App\Material', 'material_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
