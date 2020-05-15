<?php


namespace App\Traits;

use Illuminate\Support\Str;


Trait OfferTrait {



    public function saveImage($photo,$folder){

        if($photo){

            $file_extension = $photo ->getClientOriginalExtension();
            //  $file_name = $request -> photo ->getClientOriginalName();
             $file_name =Str::random(10).'_'.time().'.'.$file_extension;
             $photo ->move($folder,$file_name);
             return $folder.'/'.$file_name;
        }
        else{

            return null;
        }

   }


   public function removeImage($photo){

    if($photo){

        unlink($photo);

     }

    }


}
