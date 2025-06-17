<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            ["name"=>"Suporte", "email"=> "suporte@gmail.com", "password"=>Hash::make("a1b2c3d4e5"),"created_at"=>now()],
        ]);
    }
}
