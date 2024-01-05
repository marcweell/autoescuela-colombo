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
        Schema::table('course_attachment', function (Blueprint $table) {
            $table->foreign(['course_id'], 'course_attachment_ibfk_1')->references(['id'])->on('course')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_attachment', function (Blueprint $table) {
            $table->dropForeign('course_attachment_ibfk_1');
        });
    }
};
