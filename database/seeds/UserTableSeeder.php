<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//$datetime = Carbon::now('Asia/Bangkok');
    	$date = new DateTime();
    	$date->setTimezone(new DateTimeZone('Asia/Bangkok'));

        DB::table('users')->insert([
            'name' => 'Snooker Koleng',
            'firstName' => 'Jirayut',
            'lastName' => 'Khantavee',
            'cardID' => '1350100240034',
            'phone' => '0874652849',
            'code' => $date->format('YmdHis'),
            'email' => 'ker.koleng@hotmail.co.th',
            'password' => bcrypt('kantavee'),
            'created_at' => $date->format('Y-m-d H:i:s'),
            'role' => 99
        ]);
    }
}
