<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturer', function (Blueprint $table) {
            $table->id('manufacturer_id');
            $table->foreignId('country_id')->constrained('country', 'country_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('abbr', 4)->unique();
            $table->string('logo_URL');
            //administrations
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
        Schema::create('manufacturer', function (Blueprint $table) {
          $table->dropForeign(['country_id']);
        });
        Schema::dropIfExists('manufacturer');
    }
}
