<?php

namespace App\Console\Commands;

use App\Custom\Results\ChampionshipResult;
use App\Exceptions\ResultsLockedException;
use App\Models\Championship;
use Illuminate\Console\Command;

class ChampionshipResultCalculate extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'championship_results:calculate {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate results for championship identified by its #id. If is written "all" instead of #id, the calculation is done for all championships.';

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
            foreach(Championship::all() as $championship){
                try{
                    ChampionshipResult::calculate( $championship->championship_id );
                }
                catch(ResultsLockedException $e){
                    continue;
                }

            }
        }else{
            try{
                ChampionshipResult::calculate( $this->argument( 'id' ) );
            }
            catch(ResultsLockedException $e){
                echo $e->getMessage();
            }
        }

        return true;
    }
}
