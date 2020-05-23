<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Doctor;


class Medical extends Model
{
    
    protected $fillable = ['pdf','patient_id'];

    protected $hidden = ['created_at','updated_at'];


    ################################### BEGIN Relations ########################################

        
        //// ================== Relation Patient with Medical One To One ================== ////
 
        public function patient(){

            return $this->belongsTo(Patient::class);

        }


        //// ================== Relation doctor with Medical One To One ================== ////
         

        public function doctor(){

            return $this->hasOne(Doctor::class);

        }



    ################################### END Relations ########################################



}
