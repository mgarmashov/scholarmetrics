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
        factory(User::class)->create([
            'login' => 'root',
            'name' => 'Root',
            'surname' => 'Root',
            'password' => Hash::make('moscow')
        ]);

        factory(User::class)->create([
            'login' => 'Thomas',
            'name' => 'Thomas',
            'surname' => 'Sanchez',
            'password' => Hash::make('0000')
        ]);
    }
}
