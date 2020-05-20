<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Phone;
use App\User;
use App\Models\Hospital;
use App\Models\Doctor;



class RelationsController extends Controller
{


################################ BEGIN Methods relations One To One  #####################################


    public function hasOneRelation(){

        $user = User::with(['phone'=>function($q){
            $q->select('code','phone','user_id');
        }])->find(1);

        // $phone = $user->phone;

        return response()->json($user);

    }


    public function hasOneRelationReverse(){

        $phone = Phone::with(['user'=>function($q){
            $q->select('id','name');
        }])->find(1);

          /// make some attributes visible
        // $phone->makeVisible(['user_id']); 

          /// make some attributes hidden
       // $phone->makeHidden(['code']);

      // $user = $phone->user;

        return $phone;

    }


    public function getUserHasPhone(){

        return User::whereHas('phone')->get();
    }

    public function getUserHasNotPhone(){

        return User::whereDoesntHave('phone')->get();

    }

    public function getUserHastPhoneCondition(){

        return User::whereHas('phone',function($q){
            $q->where('code','>',522);
        })->get();


    }


 ################################ END Methods relations One To One  #####################################



################################ BEGIN Methods relations One To Many  #####################################


    public function getHospitalDoctors(){


       $hospital =  Hospital::with('doctors')->find(1); // Hospital::where('id',1)->first(); // Hospital::first();


         foreach($hospital->doctors as $doctor){
  
            echo $doctor->title.'<br>';
       
        }


    }


    public function getAllHospitals(){

        $hospitals =  Hospital::select('id','name','address')->get(); 

        return view('doctors.hospitals',compact('hospitals'));

    }


    public function getAllDoctorsHospital($id){

        // $hospitals = Hospital::find($id);

        // $doctors = $hospitals->doctors;

        $doctors = Doctor::where('hospital_id',$id)->get();

        return view('doctors.doctors',compact('doctors'));


    }

    public function getHospitalsHasDoctors(){


        return   $hospitals = Hospital::whereHas('doctors')->get();

    }


    public function getHospitalsHasNotDoctors(){


        return   $hospitals = Hospital::whereDoesntHave('doctors')->get();

    }

    public function getHospitalsHasDoctorsMale(){

        return   $hospitals = Hospital::whereHas('doctors',function($q){
            $q->where('sex','male');
        })->get();

    }





################################ END Methods relations One To Many  #####################################


    
}
