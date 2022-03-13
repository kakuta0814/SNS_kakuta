<?php

use Illuminate\Database\Seeder;

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
        DB::table('users')->insert([
            'username' => 'kakuta',
            'mail' => 'kakuta.s0814@gmail.com',
            'password' => 'kakuta0814'
        ]);
    }
}
