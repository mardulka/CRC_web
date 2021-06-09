<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rank', function (Blueprint $table) {
            $table->id('user_rank_id');
            $table->foreignId('user_id')->constrained('user', 'user_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('rank_id')->constrained('rank', 'rank_id')->onUpdate('cascade')->onDelete('cascade');
            $table->date('from');
            $table->date('to');
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
        Schema::dropIfExists('user_rank');
    }
}
