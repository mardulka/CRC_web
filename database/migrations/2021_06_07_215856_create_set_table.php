<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'set', function( Blueprint $table ){
            $table->foreignId( 'championship_id' )->constrained( 'championship', 'championship_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->integer( 'set_id' );
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->primary(['championship_id', 'set_id']);
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'set', function( Blueprint $table ){
            $table->dropPrimary(['championship_id', 'set_id']);
            $table->dropForeign(['championship_id']);
        } );

        Schema::dropIfExists( 'set' );
    }
}
