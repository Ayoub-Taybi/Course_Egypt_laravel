<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Phone extends Model
{
    
    protected $fillable = ['phone','code','user_id'];


     protected $hidden = ['user_id'];




    ################################### BEGIN Relations ########################################


          //// ================== Relation phone with user One To One ================== ////

          public function user(){

            return $this->belongsTo(User::class,'user_id','id');

          }



    ################################### END Relations ########################################


}
