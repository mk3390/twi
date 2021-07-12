<?php

namespace App\Console\Commands;

use App\Models\Timeline;
use App\Models\User;
use Illuminate\Console\Command;

class ProcessData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        User::factory()->hasTimeline(1)->create()->each(function($u) {
           dd($u->timeline()->hasPosts(5));
        });
    }
}
