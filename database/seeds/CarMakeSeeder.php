<?php

use App\Models\CarMake;
use Illuminate\Database\Seeder;

class CarMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CarMake::class, 10)->create();
    }
}
