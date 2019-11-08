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
        User::insert([
            'name' => 'admin',
            'username' => 'admin',
            'role_id' => 1,
            'email' => 'abc@test.com',
            'password' => bcrypt('12345')
        ]);
    }
}
