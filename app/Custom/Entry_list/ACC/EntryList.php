<?php

namespace App\Custom\Entry_list\ACC;

use App\Custom\Entry_list\ACC\Driver;
use App\Custom\Entry_list\ACC\EList;
use App\Custom\Entry_list\ACC\Entry;
use App\Models\Championship;
use App\Models\Participation;
use App\Models\Race;
use App\Models\Set;
use Illuminate\Support\Collection;

/**
 * Creates entry list for given race in ACC
 */
class EntryList{

    /**
     * Race_id from DB
     *
     * @var int
     */
    private static int $id;

    /**
     * Race from DB
     *
     * @var Race
     */
    private static Race $race;

    /**
     * Set from DB
     *
     * @var Set
     */
    private static Set $set;


    /**
     * Championship from DB
     *
     * @var Championship
     */
    private static Championship $championship;

    /**
     * Participation from DB
     *
     * @var Championship
     */
    private static Collection $participation;


    /**
     * Collection of rank in championship from DB
     *
     * @var Collection
     */
    private static Collection $ranks;


    public static function generate( $id ) : bool{
        self::$id = $id;

        //load data from DB
        if(!self::DbLoad()){
            return false;
        }

        $list = new EList();
        $list->entries = [];
        $entry = new Entry();
        $driver = new Driver();

        foreach(self::$participation as $partip){
            //check activity
            if(!$partip->active)
                continue;

            $entry->drivers = [];
            $entry->raceNumber = $partip->car_no;
            $entry->forcedCarModel = -1;
            $entry->overrideDriverInfo = 1;
            $entry->defaultGridPosition = -1;
            $entry->ballastKg = 0;
            $entry->restrictor = 0;
            $entry->customCar = $partip->applications()->where( "set_id", self::$set->set_id )->first()->livery()->first()->name;
            $entry->overrideCarModelForCustomCar = 1;
            $entry->isServerAdmin = 0;

            $driver->firstName = iconv('UTF-8', 'ASCII//TRANSLIT',$partip->driver_first_name);
            $driver->lastName = iconv('UTF-8', 'ASCII//TRANSLIT',$partip->driver_last_name);
            //$driver->lastName = mb_convert_encoding($partip->driver_last_name, "ASCII", "UTF-8");
            $driver->shortName = $partip->driver_short_name;
            $driver->nationality = $partip->user()->first()->country()->first()->simulators()->where('simulator.simulator_id', self::$championship->simulator_id)->first()->pivot->sim_country_id;
            $driver->driverCategory = $partip->applications()->where( "set_id", self::$set->set_id )->first()->rank()->first()->simulators()->where('simulator.simulator_id', self::$championship->simulator_id)->first()->pivot->sim_rank_id;
            $driver->playerID = 'S'.$partip->user()->first()->steam_id;
            array_push( $entry->drivers, clone($driver) );
            array_push( $list->entries, clone($entry) );
        }

        echo json_encode($list);

        // store JSON in DB


        return true;
    }


    /**
     * Loading Data from database
     *
     * @return bool
     */
    private static function DbLoad() : bool{

        //load race
        if(!self::$race = Race::find( self::$id ))
            return false;

        //load set
        if(!self::$set = self::$race->set()->first())
            return false;

        //load championship
        if(!self::$championship = self::$set->championship()->first())
            return false;

        //load ranks and sort by rank order
        if(!self::$ranks = self::$championship->ranks()->get()->sortBy( 'rank_order' ))
            return false;

        //load ranks and sort by rank order
        if(!self::$participation = self::$championship->participation()->get()->sortBy( 'driver_last_name' )->sortBy( 'driver_first_name' ))
            return false;

        return true;
    }


}
