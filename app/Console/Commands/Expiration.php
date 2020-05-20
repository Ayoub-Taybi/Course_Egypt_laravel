<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire users every minute automaticaly';

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
        $users = User::where('expire',true)->get();

        foreach($users as $user){

            $user->update(['expire'=>false]);

        }
    }
}
