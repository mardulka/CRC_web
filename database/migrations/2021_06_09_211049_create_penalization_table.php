<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenalizationTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'penalization', function( Blueprint $table ){
            $table->id( 'penalization_id' );
            $table->string( 'name' )->unique();
            $table->text( 'description' );
            $table->time( 'time_penalty' );
            $table->unsignedInteger( 'position_penalty' );
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
        Schema::dropIfExists( 'penalization' );
    }
}
