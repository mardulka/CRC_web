<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveryTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'livery', function( Blueprint $table ){
            $table->id( 'livery_id' );
            $table->string( 'name' );
            $table->foreignId( 'owner_id' )->nullable()->constrained( 'user', 'user_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'car_id' )->constrained( 'car', 'car_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            //Administration
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
        Schema::create( 'livery', function( Blueprint $table ){
            $table->dropPrimary(['livery_id']);
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['car_id']);
        } );

        Schema::dropIfExists( 'livery' );
    }
}
