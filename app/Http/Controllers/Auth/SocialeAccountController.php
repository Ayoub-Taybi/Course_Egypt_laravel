<?php

namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Validator,Redirect,Response,File;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\Models\SocialeAccount;
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


  private function createUser($getInfo,$provider){
 
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
              ]);

            return $user;

          }else{

              if(!$user->email_verified_at){

                 $user->update([
                  'email_verified_at'=>now(),
               ]);

              }

              $user->accounts()->create([
                  'provider_id'     => $getInfo->id,
                  'provider_name'    => $provider,
              ]);

        return $user;

         }
   
    }else{

        $user = User::find($account->user_id);
         return $user;

     }

   }


}
