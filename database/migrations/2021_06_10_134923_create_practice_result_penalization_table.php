<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeResultPenalizationTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'practice_result_penalization', function( Blueprint $table ){
            $table->foreignId( 'practice_result_id' )->constrained( 'practice_result', 'practice_result_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'penalization_id' )->constrained( 'penalization', 'penalization_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->softDeletes();
            $table->timestamps();

            $table->primary( [ 'qualify_result_id', 'penalization_id' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'practice_result_penalization', function( Blueprint $table ){
            $table->dropForeign( [ 'practice_result_id' ] );
            $table->dropForeign( [ 'penalization_id' ] );
        } );

        Schema::dropIfExists( 'practice_result_penalization' );
    }
}
