<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//         User::factory()->create([
//             'name' => 'Torocsik Tibor',
//             'email' => 'test@example.com',
//             'password' => Hash::make('123'),
//             'leave_number' => 20,
//             'children' => 1,
//             'birthday' => '1995-10-18 11:04:44',
//         ]);

        DB::table('users')->insert([
            'name' => 'Torocsik Tibor',
            'email' => 'test@example.com',
            'password' => Hash::make('123'),
            'leave_number' => 20,
            'children' => 1,
            'birthday' => '1995-10-18 11:04:44',
        ]);
    }
}
