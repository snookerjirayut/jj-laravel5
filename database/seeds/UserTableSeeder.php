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
            'name' => 'Pathma In',
            'firstName' => 'Pathma',
            'lastName' => 'Inpromma',
            'cardID' => '1490300066761',
            'phone' => '0909359085',
            'code' => $date->format('YmdHis'),
            'email' => 'mychappa@gmail.com',
            'password' => bcrypt('kantavee'),
            'created_at' => $date->format('Y-m-d H:i:s'),
            'role' => 99
        ]);
    }
}
