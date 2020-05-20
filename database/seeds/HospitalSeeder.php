<?php

use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberHospitals =(int)$this->command->ask("How maney of Hopitals you want to generate",10);

        factory(Hospital::class,$numberHospitals)->create();

    }
}
