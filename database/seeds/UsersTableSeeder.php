<?php

use Illuminate\Database\Seeder;
use App\Models\User;

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
            'email' => 'mikhail.garmashov@gmail.com',
            'password' => Hash::make('moscow')
        ]);

        factory(User::class)->create([
            'login' => 'Thomas',
            'name' => 'Thomas',
            'surname' => 'Sanchez',
            'email' => 'tomwsanchez@yahoo.com',
            'password' => Hash::make('0000')
        ]);
    }
}
