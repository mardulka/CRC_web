<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'race', function( Blueprint $table ){
            $table->id('race_id');
            $table->unsignedInteger('race_no');
            $table->foreignId( 'set_id' )->constrained('set', 'set_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('circuit_layout_id')->constrained('circuit_layout', 'circuit_layout_id')->onUpdate('cascade')->onDelete('cascade');
            //data
            $table->string('name');
            $table->date('date');
            $table->time('time');
            $table->dateTime('ingame_start');
            $table->time('dur_time');
            $table->integer('dur_laps');
            $table->integer('mand_pits');
            $table->boolean('mand_wheels');
            $table->boolean('mand_refuel');
            $table->text('weather');
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['set_id', 'race_no']);

        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'race', function( Blueprint $table ){
            $table->dropPrimary(['race_id']);
            $table->dropForeign(['set_id']);
            $table->dropForeign(['circuit_layout_id']);

        });

        Schema::dropIfExists( 'race' );
    }
}
