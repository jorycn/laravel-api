<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create(
            ['name' => 'X man',
            'phone' => '18100008888',
            'password' => bcrypt('secret')]
        );
        //
        // factory('App\User', 50)->create();
    }
}
