<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedKelas extends Model
{
    protected $table = 'featured_class';
    protected $fillable = ['class_id','valid_until'];

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'class_id');
    }
}
