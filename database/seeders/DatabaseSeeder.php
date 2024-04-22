<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $currentDate = Carbon::now();

        DB::table('users')->insert([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        DB::table('categories')->insert([
            'category_name' => 'Apple',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Orange',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Pear',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);
    }
}
