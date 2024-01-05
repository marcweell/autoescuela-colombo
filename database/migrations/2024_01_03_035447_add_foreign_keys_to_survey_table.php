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
        Schema::table('survey', function (Blueprint $table) {
            $table->foreign(['survey_category_id'], 'survey_ibfk_2')->references(['id'])->on('survey_category')->onDelete('CASCADE');
            $table->foreign(['language_id'], 'survey_ibfk_1')->references(['id'])->on('language')->onDelete('CASCADE');
            $table->foreign(['course_id'], 'survey_ibfk_3')->references(['id'])->on('course')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey', function (Blueprint $table) {
            $table->dropForeign('survey_ibfk_2');
            $table->dropForeign('survey_ibfk_1');
            $table->dropForeign('survey_ibfk_3');
        });
    }
};
