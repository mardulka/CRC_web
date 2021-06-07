<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionshipTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'championship', function( Blueprint $table ){
            $table->id( 'championship_id' );
            $table->foreignId( 'season_id' )->constrained( 'season', 'season_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'series_id' )->constrained( 'series', 'series_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->string( 'description' )->nullable();
            $table->boolean( 'publicable' );
            $table->softDeletes();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'championship', function( Blueprint $table ){
            $table->dropPrimary(['championship_id']);
            $table->dropForeign(['season_id']);
            $table->dropForeign(['series_id']);
        } );

        Schema::dropIfExists( 'championship' );
    }
}
