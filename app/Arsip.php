<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
