<?php

namespace App\Console\Commands;

use App\Custom\Entry_list\ACC\EntryList;
use Illuminate\Console\Command;

class EntryListGen extends Command{
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
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle(){
        EntryList::generate( $this->argument( 'id' ) );
        return true;
    }
}
