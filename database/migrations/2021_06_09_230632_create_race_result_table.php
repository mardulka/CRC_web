<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceResultTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'race_result', function( Blueprint $table ){
            $table->id( 'race_result_id' );
            $table->foreignId( 'race_id' )->constrained( 'race', 'race_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'participation_id' )->constrained( 'participation', 'participation_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'penalty_flag_id' )->nullable()->constrained( 'penalty_flag', 'penalty_flag_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'valuation_id' )->nullable()->constrained( 'valuation', 'valuation_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->time( 'best_lap' );
            $table->unsignedInteger( 'laps_completed' );
            $table->unsignedInteger( 'pitstops_no' );
            $table->text( 'note' );
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->unique( [ 'race_id', 'participation_id' ] );
            $table->unique( [ 'race_id', 'valuation_id' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'race_result', function( Blueprint $table ){
            $table->dropUnique(['race_id', 'participation_id']);
            $table->dropUnique(['race_id', 'valuation_id']);

            $table->dropForeign(['race_id']);
            $table->dropForeign(['participation_id']);
            $table->dropForeign(['penalty_flag_id']);
            $table->dropForeign(['valuation_id']);
        } );

        Schema::dropIfExists( 'race_result' );
    }
}
