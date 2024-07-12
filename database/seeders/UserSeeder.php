<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "firstname" => "Rohit",
                "lastname" => "Sharma",
                "email" => "rohit@gmail.com",
                "password" => Hash::make('12345678'),
                "type" => "Reporter"
            ],
            [
                "firstname" => "John",
                "lastname" => "Buffett",
                "email" => "john@gmail.com",
                "password" => Hash::make('12345678'),
                "type" => "Reporter"
            ]
        ];

        foreach($data as $key => $val) {

            if(User::where('email', $val['email'])->doesntExist()) {

                User::create($val);

            }

        }
    }
}
