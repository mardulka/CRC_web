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
            $table->foreignId( 'circuit_id' )->constrained( 'circuit', 'circuit_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->string( 'name' );
            $table->year( 'year' );
            $table->string('map_URL')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->primary( [ 'circuit_id', 'name', 'year' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'circuit_layout', function( Blueprint $table ){
            $table->dropPrimary([ 'circuit_id', 'name', 'year' ]);
            $table->dropForeign(['circuit_id']);

        });

            Schema::dropIfExists( 'circuit_layout' );
        }
}
