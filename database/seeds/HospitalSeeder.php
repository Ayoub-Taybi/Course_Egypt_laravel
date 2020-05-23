<?php

use Illuminate\Database\Seeder;
use App\Models\Hospital;
use App\Models\Country;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $countries = Country::all();

        if($countries->count()==0){
            $this->command->info('you must to add countries !!!');
            return;
        }

           
        $numberHospitals =(int)$this->command->ask("How maney of Hopitals you want to generate",10);

        factory(Hospital::class,$numberHospitals)->make()->each(function($hospital)use($countries){

            $hospital->country_id = $countries->random()->id;

            $hospital->save();

        });



    }
}
