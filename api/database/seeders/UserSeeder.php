<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * php artisan db:seed --class=UserSeeder
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Teste",
            'phone' => "",
            'photo' => '',
            'email' => 'admin2@email.com',
            'password' => bcrypt('123456')
            //'password' => Hash::make('123456')
        ]);
    }
}
