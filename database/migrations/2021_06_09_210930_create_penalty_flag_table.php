<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltyFlagTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'penalty_flag', function( Blueprint $table ){
            $table->id( 'penalty_flag_id' );
            $table->string( 'name' )->unique();
            $table->text( 'description' );
            //administration
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
        Schema::dropIfExists( 'penalty_flag' );
    }
}
