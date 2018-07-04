<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    //
    public function mhead(){
        return $this->belongsTo(Mhead::class);
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
}
