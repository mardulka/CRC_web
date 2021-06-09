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
            $table->id( 'set_id' );
            $table->foreignId( 'championship_id' )->constrained( 'championship', 'championship_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->integer('set_no');
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['championship_id', 'set_no']);
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'set', function( Blueprint $table ){
            $table->dropPrimary(['set_id']);
            $table->dropUnique(['championship_id', 'set_id']);
            $table->dropForeign(['championship_id']);
        } );

        Schema::dropIfExists( 'set' );
    }
}
