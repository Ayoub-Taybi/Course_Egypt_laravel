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
        
        //$this->call(UsersTableSeeder::class);

        if($this->command->confirm("Do you want to refresh the database ?")){
            $this->command->call("migrate:refresh");
            $this->command->info("Database was refreshed !");
      }


         $this->call(OfferSeeder::class);

           // we can put the classes seeder in array and give it to this method for executed
        //  $this->call([UsersTableSeeder::class,OfferSeeder::class]);

        
    }
}
