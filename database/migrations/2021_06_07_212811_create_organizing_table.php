<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizingTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'organizing', function( Blueprint $table ){
            $table->foreignId( 'championship_id' )->constrained( 'championship', 'championship_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'user_id' )->constrained( 'user', 'user_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->softDeletes();
            $table->timestamps();

            $table->primary( [ 'championship_id', 'user_id' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create('organizing', function (Blueprint $table) {
            $table->dropPrimary(['championship_id', 'user_id']);
            $table->dropForeign(['championship_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists( 'organizing' );
    }
}
