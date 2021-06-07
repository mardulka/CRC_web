<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_type', function (Blueprint $table) {
            $table->id('car_type_id');
            $table->foreignId('manufacturer_id')->constrained('manufacturer', 'manufacturer_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
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
        Schema::create('car_type', function (Blueprint $table) {
           $table->dropPrimary(['car_type_id']);
           $table->dropForeign(['manufacturer_id']);
        });

        Schema::dropIfExists('car_type');
    }
}
