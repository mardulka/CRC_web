<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeResultTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'practice_result', function( Blueprint $table ){
            $table->id( 'practice_result_id' );
            $table->foreignId('practice_id')->constrained( 'practice', 'practice_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId('participation_id')->constrained( 'participation', 'participation_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'penalty_flag_id' )->nullable()->constrained( 'penalty_flag', 'penalty_flag_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->time( 'best_lap' );
            $table->unsignedInteger( 'laps_completed' );
            $table->text( 'note' );
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['practice_id', 'participation_id']);
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'practice_result', function( Blueprint $table ){
            $table->dropUnique(['practice_id', 'participation_id']);

            $table->dropForeign(['practice_id']);
            $table->dropForeign(['participation_id']);
            $table->dropForeign(['penalty_flag_id']);
        } );

        Schema::dropIfExists( 'practice_result' );
    }
}
