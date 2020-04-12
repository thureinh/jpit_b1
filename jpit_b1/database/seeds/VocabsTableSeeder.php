<?php

use Illuminate\Database\Seeder;

class VocabsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vocab::class, 100)->create();
    }
}
