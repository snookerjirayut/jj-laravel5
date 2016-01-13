<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin green vintage account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        //
        $result = \DB::table('users')->insert([
            'name' =>  $email ,
            'firstName' => 'Admin-'.date('YmdHis'),
            'lastName' => 'Inpromma',
            'cardID' => '1490300066761',
            'phone' => '0909359085',
            'code' => date('YmdHis'),
            'email' => $email,
            'password' => bcrypt($password),
            'created_at' => date('Y-m-d H:i:s'),
            'role' => 99,
            'isAdmin' =>1
        ]);

        if($result)  $this->info('Create success.');

    }
}
