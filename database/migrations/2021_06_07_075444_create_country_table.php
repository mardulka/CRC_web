<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->id('country_id');
            $table->foreignId('continent_id')->constrained('continent', 'continent_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->char('abbr',3)->unique();
            $table->string('flag_URL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('country', function(Blueprint $table){
            $table->dropForeign(['continent_id']);
        });

        Schema::dropIfExists('country');

    }
}
