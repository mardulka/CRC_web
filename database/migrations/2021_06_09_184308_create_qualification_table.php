<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'qualification', function( Blueprint $table ){
            $table->id( 'qualification_id' );
            $table->foreignId( 'race_id' )->constrained( 'race', 'race_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->unsignedInteger( 'qualification_no' );
            //data
            $table->string( 'name' );
            $table->date( 'date' );
            $table->time( 'time' );
            $table->dateTime( 'ingame_start' );
            $table->time( 'dur_time' );
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->unique( [ 'race_id', 'qualification_no' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'qualification', function( Blueprint $table ){
            $table->dropPrimary( [ 'qualification_id' ] );
            $table->dropForeign( [ 'race_id' ] );
            $table->dropUnique( [ 'race_id', 'qualification_no' ] );
        });

        Schema::dropIfExists( 'qualification' );
    }
}
