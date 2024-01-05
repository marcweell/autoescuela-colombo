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
        Schema::table('survey_question', function (Blueprint $table) {
            $table->foreign(['survey_id'], 'survey_question_ibfk_1')->references(['id'])->on('survey')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_question', function (Blueprint $table) {
            $table->dropForeign('survey_question_ibfk_1');
        });
    }
};
