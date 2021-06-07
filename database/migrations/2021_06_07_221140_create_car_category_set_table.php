<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarCategorySetTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'car_category_set', function( Blueprint $table ){
            $table->foreignId( 'car_category_id' )->constrained( 'car_category', 'car_category_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'championship_id' )->constrained( 'championship', 'championship_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->timestamps();

            $table->primary( [ 'car_category_id', 'championship_id' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'car_category_set', function( Blueprint $table ){
            $table->dropPrimary( [ 'car_category_id', 'championship_id' ] );
            $table->dropForeign(['car_category_id']);
            $table->dropForeign(['championship_id']);
        } );

        Schema::dropIfExists( 'car_category_set' );
    }
}
