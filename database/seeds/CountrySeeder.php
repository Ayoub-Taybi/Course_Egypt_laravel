<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $numberCountries = (int)$this->command->ask('How many country you wanna generate ??',5);

         factory(Country::class,$numberCountries)->create();

    }


}
