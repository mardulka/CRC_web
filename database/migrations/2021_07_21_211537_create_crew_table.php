<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'crew', function( Blueprint $table ){
            $table->id( 'crew_id' );
            $table->boolean( 'active' );
            $table->softDeletes();
            $table->timestamps();
        } );

        Schema::create( 'user_crew', function( Blueprint $table ){
            $table->foreignId( 'user_id' )->constrained( 'user', 'user_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreignId( 'crew_id' )->constrained( 'crew', 'crew_id' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->softDeletes();
        } );

        Schema::table( 'participation', function( Blueprint $table ){
           $table->foreignId('crew_id')->after('user_id')->constrained('crew', 'crew_id')->onUpdate( 'cascade' )->onDelete( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table( 'user_crew', function( Blueprint $table ){
            $table->dropForeign( [ 'crew_id' ] );
            $table->dropForeign( [ 'user_id' ] );
        } );

        Schema::table( 'crew', function( Blueprint $table ){
            $table->dropPrimary( [ 'crew_id' ] );
        } );

        Schema::table( 'participation', function( Blueprint $table ){
            $table->dropForeign( [ 'crew_id' ] );
        } );

        Schema::dropIfExists( 'crew' );
        Schema::dropIfExists( 'user_crew' );


    }
}
