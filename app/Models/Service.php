<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;


class Service extends Model
{

    protected $fillable = ['name'];

    protected $hidden = ['created_at','updated_at'];



    ################################### BEGIN Relations ########################################


    public function doctors(){

        return $this->belongsToMany(Doctor::class,'doctor_services','service_id','doctor_id','id','id');

    }





    ################################### END Relations ########################################






}
