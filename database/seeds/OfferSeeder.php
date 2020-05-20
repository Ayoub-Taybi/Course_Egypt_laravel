<?php

use Illuminate\Database\Seeder;
use App\Models\Offer;


class OfferSeeder extends Seeder
{



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $numberOffers =(int)$this->command->ask("How maney of Offers you want to generate",30);

        factory(Offer::class,$numberOffers)->create();

    }
}
