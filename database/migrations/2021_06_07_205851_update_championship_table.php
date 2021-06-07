<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChampionshipTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table( 'championship', function( Blueprint $table ){
            $table->foreignId( 'simulator_id' )->after( 'series_id' )->constrained( 'simulator', 'simulator_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table( 'championship', function( Blueprint $table ){
            $table->dropForeign(['simulator_id']);
        } );
    }
}
