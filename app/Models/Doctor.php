<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;
use App\Models\Service;
use App\Models\Medical;



class Doctor extends Model
{
    
    protected  $fillable = ['name','title','sex','medical_id','hospital_id'];

    protected  $hidden = ['medical_id','hospital_id','created_at','updated_at'] ;


    ################################### BEGIN Relations ########################################


    public function hospital(){

        return $this->belongsTo(Hospital::class,'hospital_id','id');


    }

    
    public function services(){

        return $this->belongsToMany(Service::class,'doctor_services')->withTimestamps();


        // ->withPivot('column1', 'column2'); By default, only the model keys will be present on the pivot object.
        //  If your pivot table contains extra attributes, you must specify them when defining the relationship.

        // ->withTimestamps(); If you want your pivot table to have automatically maintained created_at and updated_at timestamps,
        // use the withTimestamps method on the relationship definition:

        // ->as('newName'); renam model itermediate table by default pivot

    }


       //// ================== Relation Medical with Doctor One To One ================== ////


         public function medical(){

             return $this->belongsTo(Medical::class);

          }



    ################################### END Relations ########################################



}
