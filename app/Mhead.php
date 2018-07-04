<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mhead extends Model
{
    //
    public function firm(){
        return $this->belongsTo(Firm::class);
    }
    public function heads(){
        return $this->hasMany(Head::class);
    }
}
