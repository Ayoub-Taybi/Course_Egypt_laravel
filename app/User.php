<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\SocialeAccount;
use App\Models\Phone;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','email_verified_at','expire','age','active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


   ################################### BEGIN Relations ########################################



         //// ================== Relation user with SocialeAccount One TO Many ================== ////

     
    public function accounts(){

        return $this->hasMany(SocialeAccount::class);

    }


         //// ================== Relation user with phone One To One ================== ////


    public function phone(){

        return $this->hasOne(Phone::class,'user_id','id');

    }



    ################################### END Relations ########################################



}
