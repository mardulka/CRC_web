<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceResultPenalizationTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'race_result_penalization', function( Blueprint $table ){
            $table->foreignId( 'race_result_id' )->constrained( 'race_result', 'race_result_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'penalization_id' )->constrained( 'penalization', 'penalization_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->softDeletes();
            $table->timestamps();

            $table->primary( [ 'race_result_id', 'penalization_id' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'race_result_penalization', function( Blueprint $table ){
            $table->dropForeign( [ 'race_result_id' ] );
            $table->dropForeign( [ 'penalization_id' ] );
        } );

        Schema::dropIfExists( 'race_result_penalization' );
    }
}
