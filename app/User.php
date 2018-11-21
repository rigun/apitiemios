<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function detail(){
        return $this->hasOne(UsersDetail::class,'user_id');
    }
    public function catatan(){
        return $this->hasMany(Catatan::class,'user_id');
    }
    public function jadwal(){
        return $this->hasMany(Jadwal::class,'user_id');
    }
    public function arsip(){
        return $this->hasMany(Arsip::class,'user_id');
    }
}
