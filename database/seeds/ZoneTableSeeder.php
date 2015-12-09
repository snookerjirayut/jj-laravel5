<?php

use Illuminate\Database\Seeder;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zone')->insert([
            'name' => 'ของเก่าอะไหล่รถยนต์',
            'code' => 'D',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 200,
            'price_type2' => 150
        ]);


        DB::table('zone')->insert([
            'name' => 'ของเก่าอะไหล่รถยนต์',
            'code' => 'E',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 200,
            'price_type2' => 150
        ]);
        DB::table('zone')->insert([
            'name' => 'ของเก่าอะไหล่รถยนต์',
            'code' => 'I',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 200,
            'price_type2' => 150
        ]);
        DB::table('zone')->insert([
            'name' => 'สินค้าแฟชั่น',
            'code' => 'A',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 250,
            'price_type2' => 200
        ]);
        DB::table('zone')->insert([
            'name' => 'สินค้าแฟชั่น',
            'code' => 'B',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 250,
            'price_type2' => 200
        ]);
        DB::table('zone')->insert([
            'name' => 'สินค้าแฟชั่น',
            'code' => 'C',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 250,
            'price_type2' => 200
        ]);
        DB::table('zone')->insert([
            'name' => 'สินค้า Handmake',
            'code' => 'F',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 250,
            'price_type2' => 200
        ]);
        DB::table('zone')->insert([
            'name' => 'สินค้า Handmake',
            'code' => 'H',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 250,
            'price_type2' => 200
        ]);
        DB::table('zone')->insert([
            'name' => 'อาหารและเครื่องดื่ม',
            'code' => 'G',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 300,
            'price_type2' => 250
        ]);
        DB::table('zone')->insert([
            'name' => 'วันพฤหัสทุกโซน',
            'code' => 'ALL',
            'maxLock' => 80,
            'availableLock' => 75,
            'price_type1' => 50,
            'price_type2' => 50
        ]);
    }
}
