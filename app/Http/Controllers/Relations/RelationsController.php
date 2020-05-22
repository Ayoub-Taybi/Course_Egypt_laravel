<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Phone;
use App\User;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Service;



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


    public function deleteHospitalWithHisDoctors($id){

           $hospital = Hospital::find($id);

           if(!$hospital)
                return redirect()->back()->with(['error'=>"Delete has not been successfully"]);
   

           $hospital->doctors()->delete();
           $hospital->delete();

         
        //    $request->session()->flash('success', 'Delete has been successfully');

          return redirect()->back()->with(['success'=>"Delete has been successfully"]);

    }



################################ END Methods relations One To Many  #####################################



################################ BEGIN Methods relations Many To Many  #####################################

    public function getDoctorServices(){

        
        $doctor = Doctor::with('services')->find(1);

        return $doctor -> services;
        
    }

    public function getServiceDoctors(){

        
        $service = Service::with(['doctors'=>function($q){
            $q->select('doctors.id','name');
        }])->find(13);


         return  $service;     


    }



    public function getDoctorServicesById($id){

        $doctor = Doctor::with(['services'=>function($q){

            $q->select('services.id','name');

        }])->find($id);

        $services =  $doctor->services;

        $doctors = Doctor::select('id','name')->get();

        $allServices = Service::select('id','name')->get();



        return view('doctors.services',compact('services','doctors','allServices'));


    }


    public function saveServicesToDoctors(Request $request){

        $doctor = Doctor::find($request->doctor_id);

        if(!$doctor)
            return abort('404');

           // $doctor->services()->attach($request->servicesIds);  //save data in related model table Many to Many even if already in table

            // $doctor->services()->sync($request->servicesIds);   // save data in related model table Many to Many but it doing like update 

            $doctor->services()->syncWithoutDetaching($request->servicesIds); // save data in related model table Many to Many but it ignore duplicate value and add the values to table

            return 'success';


    }



################################ END Methods relations Many To Many  #####################################


    
}
