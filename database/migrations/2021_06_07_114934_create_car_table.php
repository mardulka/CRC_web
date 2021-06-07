<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'car', function( Blueprint $table ){
            $table->id( 'car_id' );
            $table->foreignId( 'car_type_id' )->constrained( 'car_type', 'car_type_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'car_category_id' )->constrained( 'car_category', 'car_category_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->string( 'name' );
            $table->year( 'year' );
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
        Schema::create('car', function (Blueprint $table) {
            $table->dropForeign(['car_category_id']);
            $table->dropForeign(['car_type_id']);
            $table->dropPrimary(['car_id']);
        });

        Schema::dropIfExists( 'car' );
    }
}
