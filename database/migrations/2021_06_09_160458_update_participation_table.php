<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateParticipationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participation', function(Blueprint $table){
            $table->foreignId('rank_id')->after('team_id')->constrained('rank', 'rank_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participation', function(Blueprint $table){
            $table->dropForeign(['rank_id']);
            $table->dropColumn('rank_id');
        });
    }
}
