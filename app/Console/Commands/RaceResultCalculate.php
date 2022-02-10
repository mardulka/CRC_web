<?php

namespace App\Console\Commands;

use App\Custom\Results\RaceResult;
use App\Exceptions\ResultsLockedException;
use App\Models\Race;
use App\Models\Race_result;
use Illuminate\Console\Command;

class RaceResultCalculate extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'race_results:calculate {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate results for race identified by its #id. If is written "all" instead of #id, the calculation is done for all races.';

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
            foreach(Race::all() as $race){
                try{
                    RaceResult::calculate( $race->race_id );
                }
                catch(ResultsLockedException $e){
                    continue;
                }

            }
        }else{
            try{
                RaceResult::calculate( $this->argument( 'id' ) );
            }
            catch(ResultsLockedException $e){
                echo $e->getMessage();
            }
        }

        return true;
    }
}
