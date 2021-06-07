<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircuitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuit', function (Blueprint $table) {
            $table->id('circuit_id');
            $table->foreignId('country_id')->constrained('country', 'country_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('logo_URL');
            //administration
            $table->softDeletes();
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
        Schema::create('circuit', function (Blueprint $table) {
           $table->dropForeign(['country_id']);
        });

        Schema::dropIfExists('circuit');
    }
}
