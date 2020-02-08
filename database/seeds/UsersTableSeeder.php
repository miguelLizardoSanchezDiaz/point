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
        factory(App\User::class)->create([
            'name'=>'Miguel Sánchez',            
            'email'=>'shagui2607@gmail.com',
            'password'=>bcrypt('123456')
            ]);
    }
}
