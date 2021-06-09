<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'participation', function( Blueprint $table ){
            $table->id( 'participation_id' );
            $table->foreignId( 'championship_id' )->constrained( 'championship', 'championship_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'user_id' )->constrained( 'user', 'user_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'team_id' )->constrained( 'team', 'team_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->integer( 'car_no' );
            $table->boolean( 'confirmed' );
            //administration
            $table->boolean( 'active' );
            $table->softDeletes();
            $table->timestamps();

            $table->unique( [ 'championship_id', 'user_id', 'team_id' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'participation', function( Blueprint $table ){
            $table->dropPrimary(['participation_id']);
            $table->dropForeign(['championship_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['team_id']);
        } );

        Schema::dropIfExists( 'participation' );
    }
}
