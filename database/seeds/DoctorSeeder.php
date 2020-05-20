<?php

use Illuminate\Database\Seeder;
use App\Models\Hospital;
use App\Models\Doctor;


class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $hospitals = Hospital::all();

        if($hospitals->count()==0){

            $this->command->info('you must to sedeer Hoptals first before doctors !!!');
            return;

        }
        
        $numberDoctors =(int)$this->command->ask("How maney of Doctors you want to generate",10);

        factory(Doctor::class,$numberDoctors)->make()->each(function($doctor) use ($hospitals){

            $doctor->hospital_id =  $hospitals->random()->id;

            $doctor->save();

        });


    }
}
