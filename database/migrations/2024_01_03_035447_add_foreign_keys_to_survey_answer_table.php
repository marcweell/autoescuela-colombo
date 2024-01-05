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
        Schema::table('survey_answer', function (Blueprint $table) {
            $table->foreign(['survey_question_id'], 'survey_answer_ibfk_2')->references(['id'])->on('survey_question')->onDelete('CASCADE');
            $table->foreign(['survey_question_option_id'], 'survey_answer_ibfk_1')->references(['id'])->on('survey_question_option')->onDelete('CASCADE');
            $table->foreign(['survey_person_id'], 'survey_answer_ibfk_3')->references(['id'])->on('survey_person')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_answer', function (Blueprint $table) {
            $table->dropForeign('survey_answer_ibfk_2');
            $table->dropForeign('survey_answer_ibfk_1');
            $table->dropForeign('survey_answer_ibfk_3');
        });
    }
};
