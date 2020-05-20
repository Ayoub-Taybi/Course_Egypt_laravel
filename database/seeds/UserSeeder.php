<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $numberUsers =(int)$this->command->ask("How maney of Users you want to generate",5);

        factory(User::class,$numberUsers)->create();
        
    }
}
