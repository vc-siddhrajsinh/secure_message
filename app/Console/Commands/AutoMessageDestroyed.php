<?php

namespace App\Console\Commands;

use App\Message;
use Illuminate\Console\Command;

class AutoMessageDestroyed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Message:Destroyed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is help to destroyed all the system message that duration over!';

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
        try {
            messageDestroyed();

        } catch (\Exception $ex){
            \Log::error($ex->getMessage());
            dd($ex->getMessage());
            return false;
        }


    }
}
