<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership', function (Blueprint $table) {
            $table->id('membership_id');
            $table->foreignId('user_id')->constrained('user', 'user_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('team', 'team_id')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('owner');
            $table->boolean('active');
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
        Schema::create('membership', function (Blueprint $table) {
            $table->dropPrimary(['membership_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['team_id']);
        });

        Schema::dropIfExists('membership');
    }
}
