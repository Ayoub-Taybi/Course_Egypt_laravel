<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;

class Doctor extends Model
{
    
    protected  $fillable = ['name','title','hsopital_id'];

    protected  $hidden = ['hospital_id','created_at','updated_at'] ;


    ################################### BEGIN Relations ########################################


    public function hospital(){

        return $this->belongsTo(Hospital::class,'hospital_id','id');


    }



    ################################### END Relations ########################################



}
