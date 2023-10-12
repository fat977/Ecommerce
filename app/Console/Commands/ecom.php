<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ecom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecom:user {--verified}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return users count';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        if($this->option('verified')){
            echo User::where('email_verified_at','<>',null)->count();
        }else{
            echo User::count();
        }
    }
}
