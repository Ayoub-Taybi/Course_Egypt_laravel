<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SocialeAccount extends Model
{
    protected $fillable = [
        'provider_id', 'provider_name'
    ];


    public function user(){

        return $this->belongsTo(User::class);

    }


}
