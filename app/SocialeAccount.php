<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SocialeAccount extends Model
{
    protected $fillable = [
        'provider_id', 'provider_name', 'user_id'
    ];


    public function user(){

        return $this->belongsTo(User::class);

    }


}
