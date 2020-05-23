<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Medical;
use App\Models\Doctor;

class Patient extends Model
{

    protected $fillable = ['name'];

    protected $hidden = ['created_at','updated_at'];


    ################################### BEGIN Relations ########################################

        
        //// ================== Relation Patient with Medical One To One ================== ////
 
        public function medical(){

            return $this->hasOne(Medical::class);

        }

         //// ================== Relation Patient with Doctor Has One Through ================== ////
 
         public function doctor(){

            return $this->hasOneThrough(Doctor::class,Medical::class);

        }


        
         




    ################################### END Relations ########################################

    
}
