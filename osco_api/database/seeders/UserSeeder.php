<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'restaurant_id' => 1,
            'name' => 'Adil (Owner)',
            'email' => 'admin@pizzapalace.ma',
            'password' => Hash::make('securepassword123'), // Change to a secure password!
            'role' => 'owner',
        ]);
    }
}
