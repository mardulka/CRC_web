<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create( 'role', function( Blueprint $table ){
            $table->id( 'role_id' );
            $table->string('name')->unique();
            $table->string( 'description' )->nullable();
            $table->string( 'color_name' )->nullable();
            $table->string( 'color' )->nullable();
            $table->softDeletes();
            $table->timestamps();
        } );

        Schema::create( 'user_role', function( Blueprint $table ){
            $table->foreignId('user_id');
            $table->foreignId('role_id');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('role_id')->on('role')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'role_id']);
        } );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::table('user_role', function(Blueprint $table){
            $table->dropPrimary();
            $table->dropForeign('user_role_role_id_foreign');
            $table->dropForeign('user_role_user_id_foreign');
        });

        Schema::dropIfExists( 'role' );
        Schema::dropIfExists( 'user_role' );
    }
}
