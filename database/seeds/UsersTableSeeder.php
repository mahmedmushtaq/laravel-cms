<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::where('email', 'bahdcoder@gmail.com')->first();

        if (!$user) {
          User::create([
            'role' => 'admin',
            'name' => 'Kati Frantz',
            'email' => 'bahdcoder@gmail.com',
            'password' => Hash::make('password')
          ]);
        }
    }
}
