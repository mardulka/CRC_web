<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'practice', function( Blueprint $table ){
            $table->id( 'practice_id' );
            $table->foreignId( 'race_id' )->constrained( 'race', 'race_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->unsignedInteger( 'practice_no' );
            //data
            $table->string( 'name' );
            $table->date( 'date' );
            $table->time( 'time' );
            $table->dateTime( 'ingame_start' );
            $table->time( 'dur_time' );
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->unique( [ 'race_id', 'practice_no' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'practice', function( Blueprint $table ){
            $table->dropPrimary(['practice_id']);
            $table->dropForeign(['race_id']);
            $table->dropUnique( [ 'race_id', 'practice_no' ] );
        });

        Schema::dropIfExists( 'practice' );
    }
}
