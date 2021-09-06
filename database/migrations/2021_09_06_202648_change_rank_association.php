<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRankAssociation extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('participation', function(Blueprint $table){
            $table->dropForeign('participation_rank_id_foreign');
            $table->dropColumn('rank_id');
        });

        Schema::table('application', function(Blueprint $table){
            $table->foreignId('rank_id')->after('participation_id')->constrained('rank', 'rank_id')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        //
    }
}
