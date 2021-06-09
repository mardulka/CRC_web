<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'valuation', function( Blueprint $table ){
            $table->id( 'valuation_id' );
            $table->foreignId( 'point_table_id' )->constrained( 'point_table', 'point_table_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->unsignedinteger( 'position' );
            $table->unsignedinteger( 'points' );
            //administration
            $table->boolean( 'locked' );
            $table->softDeletes();
            $table->timestamps();

            $table->unique( [ 'point_table_id', 'position' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'valuation', function( Blueprint $table ){
            $table->dropPrimary( [ 'valuation_id' ] );
            $table->dropForeign( [ 'point_table_id' ] );
            $table->dropUnique( [ 'point_table_id', 'position' ] );
        } );
        Schema::dropIfExists( 'valuation' );
    }
}
