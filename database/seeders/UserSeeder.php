<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Hotel',
            'email' => 'admin@hotel.com',
            'password' => bcrypt('admin'),
        ]);

        User::factory()->count(10)->create();
    }
}
