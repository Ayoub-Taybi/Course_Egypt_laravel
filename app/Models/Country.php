<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;

class Country extends Model
{

      // protected $table='countries';

      protected  $fillable = ['name'];
 
      protected  $hidden=['created_at','updated_at'];


  ################################### BEGIN Relations ########################################



    public function hospitals(){

        return $this->hasMany(Hospital::class);

    }


    public function doctors(){

      return $this->hasManyThrough(Doctor::class,Hospital::class);

  }



    ################################### END Relations ########################################
      


}
