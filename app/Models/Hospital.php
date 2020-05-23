<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\Country;


class Hospital extends Model
{
     
        protected  $fillable = ['name','address'];

         protected  $hidden = ['created_at','updated_at'] ;



    ################################### BEGIN Relations ########################################


    public function doctors(){

        return $this->hasMany(Doctor::class,'hospital_id','id');


    }


    public function country(){

        return $this->belongsTo(Country::class);

    }



    ################################### END Relations ########################################



}
