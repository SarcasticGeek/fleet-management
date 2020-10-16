<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routes')->insert([
            [
                'bus_id' => 1,
                'station_id' => 1,
                'level' => 0,
            ],
            [
                'bus_id' => 1,
                'station_id' => 2,
                'level' => 1,
            ],
            [
                'bus_id' => 1,
                'station_id' => 3,
                'level' => 2,
            ],
            [
                'bus_id' => 1,
                'station_id' => 4,
                'level' => 3,
            ],
        ]);
    }
}