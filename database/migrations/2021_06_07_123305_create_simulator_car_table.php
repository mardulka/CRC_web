<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulatorCarTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'simulator_car', function( Blueprint $table ){
            $table->foreignId( 'car_id' )->constrained( 'car', 'car_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'simulator_id' )->constrained( 'simulator', 'simulator_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->bigInteger('simulator_car_identification');
            $table->timestamps();

            $table->primary(['car_id', 'simulator_id']);
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create('simulator_car', function (Blueprint $table) {
            $table->dropPrimary(['car_id', 'simulator_id']);
            $table->dropForeign(['car_id']);
            $table->dropForeign(['simulator_id']);
        });

        Schema::dropIfExists( 'simulator_car' );
    }
}
