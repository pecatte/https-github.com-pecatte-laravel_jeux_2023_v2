<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->delete();
        DB::table('users')->insert([
        'id' => '1',
        'name' => 'Dupont',
        'email' => 'dupont@gmail.com',
        'password' => 'dupont'
        ]);
        DB::table('users')->insert([
        'id' => '2',
        'name' => 'Durand',
        'email' => 'durand@gmail.com',
        'password' => 'durand'
        ]);
    }
}