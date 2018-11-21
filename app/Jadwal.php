<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
