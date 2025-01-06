<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ghena Alsaleh',
            'email' => 'ghena.a.s@gmail.com',
            'password'=>Hash::make('password'),
            'is_admin'=>false,
            'image'=>'flower1.jpg'
        ]);
        User::create([
            'name' => 'Ismail Othman',
            'email' => 'ismail.a.s@gmail.com',
            'password'=>Hash::make('password'),
            'is_admin'=>true,
            'image'=>'flower2.jpg'
        ]);
    }
}
