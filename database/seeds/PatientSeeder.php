<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $numberPatients= (int)$this->command->ask('How many Patient you wanna generate ?',5);
        factory(Patient::class,$numberPatients)->create();
        

    }
}
