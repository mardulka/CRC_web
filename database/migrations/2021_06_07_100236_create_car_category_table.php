<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_category', function (Blueprint $table) {
            $table->id('car_category_id');
            $table->string('name');
            $table->string('abbr', 16)->unique();
            $table->string('logo_URL');
            //administrations
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('simulator_car_category', function(Blueprint $table){
           $table->foreignId('simulator_id')->constrained('simulator', 'simulator_id')->onUpdate('cascade')->onDelete('cascade');
           $table->foreignId('car_category_id')->constrained('car_category', 'car_category_id')->onUpdate('cascade')->onDelete('cascade');
           $table->primary(['simulator_id', 'car_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simulator_car_category', function(Blueprint $table){
           $table->dropPrimary(['simulator_id', 'car_category_id']);
           $table->dropForeign(['simulator_id']);
           $table->dropForeign(['car_category_id']);
        });

        Schema::dropIfExists('simulator_car_category');
        Schema::dropIfExists('car_category');
    }
}
