<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()
        ->each(function ($user) {
            $reservations = $user->reservations()->saveMany(factory (App\Reservation::class, mt_rand(1,3))->make());

            foreach ($reservations as $reservation) {
                $room_ids = [];
                for ($i = 1; $i<= mt_rand(1,3); $i++) {
                    array_push($room_ids, mt_rand(1,20));
                }

                $reservation->rooms()->attach($room_ids, ['status' => (bool) random_int(0, 1)]);
            }
        });
    }
}
