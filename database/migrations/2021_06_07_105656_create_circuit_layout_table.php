<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircuitLayoutTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'circuit_layout', function( Blueprint $table ){
            $table->id('circuit_layout_id');
            $table->foreignId( 'circuit_id' )->constrained( 'circuit', 'circuit_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->string( 'name' );
            $table->year( 'year' );
            $table->string('map_URL')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['circuit_id', 'name', 'year']);
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'circuit_layout', function( Blueprint $table ){
            $table->dropPrimary([ 'circuit_layout_id']);
            $table->dropForeign(['circuit_id']);
            $table->dropUnique(['circuit_id', 'name', 'year']);

        });

            Schema::dropIfExists( 'circuit_layout' );
        }
}
