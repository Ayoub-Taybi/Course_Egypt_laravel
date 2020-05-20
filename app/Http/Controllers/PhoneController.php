<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Phone;
use App\User;

class PhoneController extends Controller
{



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



    
}
