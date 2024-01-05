<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('survey_person', function (Blueprint $table) {
            $table->foreign(['survey_id'], 'survey_person_ibfk_2')->references(['id'])->on('survey')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'survey_person_ibfk_1')->references(['id'])->on('user')->onDelete('CASCADE');
            $table->foreign(['city_id'], 'survey_person_ibfk_3')->references(['id'])->on('city')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_person', function (Blueprint $table) {
            $table->dropForeign('survey_person_ibfk_2');
            $table->dropForeign('survey_person_ibfk_1');
            $table->dropForeign('survey_person_ibfk_3');
        });
    }
};
