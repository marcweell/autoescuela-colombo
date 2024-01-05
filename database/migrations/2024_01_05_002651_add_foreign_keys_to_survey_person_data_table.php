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
        Schema::table('survey_person_data', function (Blueprint $table) {
            $table->foreign(['survey_person_id'], 'survey_person_data_ibfk_1')->references(['id'])->on('survey_person')->onDelete('CASCADE');
            $table->foreign(['survey_question_option_id'], 'survey_person_data_ibfk_2')->references(['id'])->on('survey_question_option')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_person_data', function (Blueprint $table) {
            $table->dropForeign('survey_person_data_ibfk_1');
            $table->dropForeign('survey_person_data_ibfk_2');
        });
    }
};
