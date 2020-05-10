<?php

namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Validator,Redirect,Response,File;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\SocialeAccount;
use Auth;


class SocialeAccountController extends Controller
{


       public function redirect($provider)
     {
          return Socialite::driver($provider)->redirect();
     }
 
     public function callback($provider)
    {

         $getInfo = Socialite::driver($provider)->stateless()->user();



         $user = $this->createUser($getInfo,$provider);
 
         Auth::login($user);
 
         return redirect()->route('home');
 
    }


    function createUser($getInfo,$provider){
 
        $account = SocialeAccount::where('provider_id', $getInfo->id)->first();
 

        if (!$account) {

           $user = User::where('email', $getInfo->email)->first();

          if(!$user){

              $user = User::create([
                 'name'     => $getInfo->name,
                 'email'    => $getInfo->email,
                 'email_verified_at'=>now(),
              ]);

              $user->accounts()->create([
                 'provider_id'     => $getInfo->id,
                 'provider_name'    => $provider,
                 'user_id' => $user->id,
              ]);

            return $user;

          }else{

              $user->accounts()->create([
                  'provider_id'     => $getInfo->id,
                  'provider_name'    => $provider,
                  'user_id' => $user->id,
              ]);

        return $user;

         }
   
    }else{

        $user = User::where('id', $account->user_id)->first();
         return $user;

     }

   }


}
