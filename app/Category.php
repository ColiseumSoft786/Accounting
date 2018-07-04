<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function head(){
        return $this->belongsTo(Head::class);
    }
    public function types(){
        return $this->hasMany(Type::class);
    }
}
