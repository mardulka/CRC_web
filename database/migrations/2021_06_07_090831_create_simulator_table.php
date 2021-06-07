<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulator', function (Blueprint $table) {
            $table->id('simulator_id');
            $table->string('name');
            $table->string('abbr', 4)->unique();
            $table->date('release_date')->nullable();
            $table->string('producer');
            $table->string('logo_URL');
            //administration
            $table->boolean('active');
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
        Schema::dropIfExists('simulator');
    }
}
