<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualifyResultTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'qualify_result', function( Blueprint $table ){
            $table->id( 'qualify_result_id' );
            $table->foreignId('qualification_id')->constrained( 'qualification', 'qualification_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId('participation_id')->constrained( 'participation', 'participation_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'penalty_flag_id' )->nullable()->constrained( 'penalty_flag', 'penalty_flag_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->time( 'best_lap' );
            $table->unsignedInteger( 'laps_completed' );
            $table->text( 'note' );
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['qualification_id', 'participation_id']);
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'qualify_result', function( Blueprint $table ){
            $table->dropUnique(['qualification_id', 'participation_id']);

            $table->dropForeign(['qualification_id']);
            $table->dropForeign(['participation_id']);
            $table->dropForeign(['penalty_flag_id']);
        } );

        Schema::dropIfExists( 'qualify_result' );
    }
}
