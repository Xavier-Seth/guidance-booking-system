<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Student
        User::create([
            'name' => 'Student User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'student',

        ]);

        //Councelor
        User::create([
            'name' => 'Counselor User',
            'email' => 'counselor@gmail.com',
            'password' => 'password',
            'role' => 'counselor',
        ]);
    }
}
