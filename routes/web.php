<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\RoomType;
use App\Reservation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $checkIn = '2021-6-27';
    $checkOut = '2021-06-29';
    $cityId = 2;
    $roomSize =2;

    // query builder search available reservation using date requests
    // $result = DB::table('rooms')->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    // ->whereNotExists(function ($query) use 
    // ($checkIn, $checkOut) {
    //     $query->select('reservations.id')
    //     ->from('reservations')
    //     ->join('reservation_room', 'reservations.id', '=', 'reservation_room.reservation_id')
    //     ->whereColumn('rooms.id', 'reservation_room.room_id')
    //     ->where(function ($q) use ($checkIn, $checkOut) {
    //         $q->where('check_out', '>', $checkIn);
    //         $q->where('check_in', '<', $checkOut);
    //     })
    //     ->limit(1);
    // })->paginate(10);


    // eloquent search available reservation using date requests
    // $result = Room::with('type')
    // ->whereDoesntHave('reservations', function($q) use ($checkIn, $checkOut) {
    //     $q->where('check_out', '>', $checkIn);
    //     $q->where('check_in', '<', $checkOut);
    // })->get();

    // query builder search with city
    // $result = DB::table('rooms')->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    // ->whereNotExists(function ($query) use 
    // ($checkIn, $checkOut) {
    //     $query->select('reservations.id')
    //     ->from('reservations')
    //     ->join('reservation_room', 'reservations.id', '=', 'reservation_room.reservation_id')
    //     ->whereColumn('rooms.id', 'reservation_room.room_id')
    //     ->where(function ($q) use ($checkIn, $checkOut) {
    //         $q->where('check_out', '>', $checkIn);
    //         $q->where('check_in', '<', $checkOut);
    //     })
    //     ->limit(1);
    // })->whereExists(function($q) use ($cityId) {
    //     $q->select('hotels.id')
    //         ->from('hotels')
    //         ->whereColumn('rooms.hotel_id', 'hotels.id')
    //         ->whereExists(function($q) use ($cityId) {
    //             $q->select('cities.id')
    //             ->from('cities')
    //             ->whereColumn('cities.id', 'hotels.city_id')
    //             ->where('id', $cityId)
    //             ->limit(1);
    //         })->limit(1);

    // })
    // ->paginate(10);


   // eloquent search available reservation using date requests with city
    // $result = Room::with(['type', 'hotel'])
    // ->whereDoesntHave('reservations', function($q) use ($checkIn, $checkOut) {
    //     $q->where('check_out', '>', $checkIn);
    //     $q->where('check_in', '<', $checkOut);
    // })->whereHas('hotel.city', function($q) use ($cityId) {
    //     $q->where('id', $cityId);
    // })->whereHas('type', function($q) use ($roomSize) {
    //     $q->where('amount', '>', 0);
    //     $q->where('size', '=', $roomSize);
    // })
    // ->paginate(10)
    // ->sortBy('type.price');


    // make a reservation

    // $roomId = 14;
    // $userId = 1;

    // $result = DB::table('rooms')->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    //     ->whereNotExists(function ($query) use 
    //     ($checkIn, $checkOut) {
    //         $query->select('reservations.id')
    //         ->from('reservations')
    //         ->join('reservation_room', 'reservations.id', '=', 'reservation_room.reservation_id')
    //         ->whereColumn('rooms.id', 'reservation_room.room_id')
    //         ->where(function ($q) use ($checkIn, $checkOut) {
    //             $q->where('check_out', '>', $checkIn);
    //             $q->where('check_in', '<', $checkOut);
    //             $q->where('room_types.amount', '=', 0);
    //         })
    //         ->limit(1);
    //     })->whereExists(function($q) use ($cityId) {
    //         $q->select('hotels.id')
    //             ->from('hotels')
    //             ->whereColumn('rooms.hotel_id', 'hotels.id')
    //             ->whereExists(function($q) use ($cityId) {
    //                 $q->select('cities.id')
    //                 ->from('cities')
    //                 ->whereColumn('cities.id', 'hotels.city_id')
    //                 ->where('id', $cityId)
    //                 ->limit(1);
    //             })->limit(1);

    //     })
    //     ->paginate(10);

    //     DB::transaction(function () use($roomId, $userId, $checkIn, $checkOut ) {
    //         $room = Room::findOrFail($roomId);

    //         $reservation = new Reservation;
    //         $reservation->user_id =$userId;
    //         $reservation->check_in = $checkIn;
    //         $reservation->check_out = $checkOut;

    //         $room->reservations()->attach($reservation->id);

    //         RoomType::where('id', $room->room_type_id) 
    //         ->where('amount', '>', 0)
    //         ->decrement('amount');

    //      });


    // Get all reservation made by user
    // $userId = 1;
    // $result = Reservation::with(['rooms.type', 'rooms.hotel'])
    // ->where('user_id', $userId)->first();

    $hotelId = [1];
    $result = Reservation::with(['rooms.type', 'user'])
    ->whereHas('rooms.hotel', function($q) use($hotelId) {
        $q->whereIn('hotel_id', $hotelId);
    })
    ->get();

    dd($result);

    return view('welcome');
});
