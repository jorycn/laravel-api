<?php

use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\BxjkVideo::truncate();

      factory(App\BxjkVideo::class, 100)->create();
      factory(App\BxjkVideo::class, 20)->create([
        'year'=>2016
      ]);

      // message
      factory(App\BxjkMessage::class, 400)->create();

    }
    
}
