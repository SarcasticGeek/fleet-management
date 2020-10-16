<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Constant\BusesCapacity;
use Illuminate\Support\Str;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses')->insert([
            'capacity' => BusesCapacity::MINI_BUS,
            'uuid' => Str::uuid()
        ]);
    }
}
