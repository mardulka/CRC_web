<?php

namespace App\Console\Commands;

use App\Custom\Results\SetResult;
use App\Exceptions\ResultsLockedException;
use App\Models\Set;
use Illuminate\Console\Command;

class SetResultCalculate extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set_results:calculate {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate results for set identified by its #id. If is written "all" instead of #id, the calculation is done for all sets.';

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

        if($this->argument( 'id' ) == 'all'){
            foreach(Set::all() as $set){
                try{
                    SetResult::calculate( $set->set_id );
                }
                catch(ResultsLockedException $e){
                    continue;
                }

            }
        }else{
            try{
                SetResult::calculate( $this->argument( 'id' ) );
            }
            catch(ResultsLockedException $e){
                echo $e->getMessage();
            }
        }

        return true;
    }
}
