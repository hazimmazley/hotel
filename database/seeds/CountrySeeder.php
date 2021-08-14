<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = factory(App\Country::class, 10)
        ->create()
        ->each(function ($country) {
            $country->cities()->saveMany(factory(App\City::class, mt_rand(1, 10)
            )->make());
        });

        foreach ($countries as $country) {
            foreach($country->cities as $city) {
                $hotels = $city->hotels()->saveMany(factory(App\Hotel::class, mt_rand(1, 4))
                ->make());

                foreach ($hotels as $hotel) {
                    $hotel->rooms()->saveMany(factory(App\Room::class, mt_rand(3, 10))
                ->make());
                }
            }
        }
    }
}
