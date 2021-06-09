<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'application', function( Blueprint $table ){
            $table->id( 'application_id' );
            $table->foreignId( 'participation_id' )->constrained( 'participation', 'participation_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'set_id' )->constrained( 'set', 'set_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'livery_id' )->constrained( 'livery', 'livery_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            //administration
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['participation_id', 'set_id']);
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::create( 'application', function( Blueprint $table ){
            $table->dropPrimary(['application_id']);
            $table->dropForeign(['participation_id']);
            $table->dropForeign(['set_id']);
            $table->dropForeign(['livery_id']);
        });

        Schema::dropIfExists( 'application' );
    }
}
