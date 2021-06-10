<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChampionshipTable2 extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table( 'championship', function( Blueprint $table ){
            $table->foreignId( 'point_table_id' )->constrained( 'point_table', 'point_table_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table( 'championship', function( Blueprint $table ){
            $table->dropForeign( [ 'point_table_id' ] );
        } );
    }
}
