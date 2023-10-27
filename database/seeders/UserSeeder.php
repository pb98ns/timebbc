<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                'name' => 'Przemysław',
                'surname' => 'Bochenek',
                'phone1' => '881585163',
                'phone2' => '881585163',
                'email' => 'przemyslaw.bochenek@biurobbc.pl',
                'password' => bcrypt('qazzaq123321'),
                'permissions' => 'Administrator',
                

 
           
        ]);
    }
}
