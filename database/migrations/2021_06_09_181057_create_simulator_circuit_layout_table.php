<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulatorCircuitLayoutTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'simulator_circuit_layout', function( Blueprint $table ){
            $table->foreignId( 'simulator_id' )->constrained( 'simulator', 'simulator_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'circuit_layout_id' )->constrained( 'simulator', 'simulator_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->softDeletes();
            $table->timestamps();

            $table->primary( [ 'simulator_id', 'circuit_layout_id' ] );

        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'simulator_circuit_layout', function( Blueprint $table ){
            $table->dropPrimary( [ 'simulator_id', 'circuit_layout_id' ] );
            $table->dropForeign(['simulator_id']);
            $table->dropForeign(['circuit_layout_id']);
        });

        Schema::dropIfExists( 'simulator_circuit_layout' );
    }
}
