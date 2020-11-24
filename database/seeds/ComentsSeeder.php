<?php

use Illuminate\Database\Seeder;

use App\coments;
class ComentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coments=factory(App\coments::class,20)->create();
    }
}
