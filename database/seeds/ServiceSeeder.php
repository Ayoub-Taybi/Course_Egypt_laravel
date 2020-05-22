<?php

use Illuminate\Database\Seeder;
use App\Models\Service;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $numbersServices = (int)$this->command->ask('How many services do you want to generate',10);

        factory(Service::class,$numbersServices)->create();

    }
}
