<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        if($this->command->confirm("Do you want to refresh the database ?")){
            $this->command->call("migrate:refresh");
            $this->command->info("Database was refreshed !");
        }


         $this->call([UserSeeder::class,OfferSeeder::class,CountrySeeder::class,HospitalSeeder::class,PatientSeeder::class,DoctorSeeder::Class,ServiceSeeder::class]);
         
         
           // we can put the classes seeder in array and give it to this method for executed
        //  $this->call([UsersTableSeeder::class,OfferSeeder::class]);

        
    }
}
