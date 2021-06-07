<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            'room' => 201,
            'amount' => 1,
            'start_date' => '2021-06-07 07:00:00',
            'end_date' => '2021-06-08 07:00:00',
            'paid' => '0',
            'price' => Room::select('price')->where('no', 201)->first()->price,
        ]);

        DB::table('bookings')->insert([
            'room' => 202,
            'amount' => 1,
            'start_date' => '2021-06-07 12:00:00',
            'end_date' => '2021-06-09 12:00:00',
            'paid' => '0',
            'price' => Room::select('price')->where('no', 202)->first()->price * 2,
        ]);
    }
}
