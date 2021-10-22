<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class entry_list_gen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entry_list:generate {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create entry list for given race id.';

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
        return 0;
    }
}
