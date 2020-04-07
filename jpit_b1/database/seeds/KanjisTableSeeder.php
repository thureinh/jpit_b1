<?php

use Illuminate\Database\Seeder;

class KanjisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Kanji::class, 500)->create();
    }
}
