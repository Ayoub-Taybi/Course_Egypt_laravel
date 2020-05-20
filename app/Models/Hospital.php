<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;


class Hospital extends Model
{
     
        protected  $fillable = ['name','address'];

         protected  $hidden = ['created_at','updated_at'] ;



    ################################### BEGIN Relations ########################################


    public function doctors(){

        return $this->hasMany(Doctor::class,'hospital_id','id');


    }



    ################################### END Relations ########################################



}
