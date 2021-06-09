<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTableTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'point_table', function( Blueprint $table ){
            $table->id( 'point_table_id' );
            $table->string( 'name' )->unique();
            //administration
            $table->boolean( 'active' );
            $table->softDeletes();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'point_table', function( Blueprint $table ){
            $table->dropUnique(['name']);
        });
        Schema::dropIfExists( 'point_table' );
    }
}
