<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    //
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Mheads(){
        return $this->hasMany(Mhead::class);
    }
}
