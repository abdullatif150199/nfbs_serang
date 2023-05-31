<?php

namespace App\Console\Commands;

use App\Libraries\SheetDB;
use App\Models\Balance;
use App\Models\FailedSppBiller;
use App\Models\SetSpp;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing running code';

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
     * @return int
     */
    public function handle()
    {
        Mail::raw('Hi, welcome user!', function ($message) {
            $message->to('akhmami@gmail.com')
                ->subject('Testing');
        });
    }
}
