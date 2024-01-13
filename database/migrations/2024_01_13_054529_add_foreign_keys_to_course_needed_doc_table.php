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
        Schema::table('course_needed_doc', function (Blueprint $table) {
            $table->foreign(['course_id'], 'course_needed_doc_ibfk_1')->references(['id'])->on('course')->onDelete('CASCADE');
            $table->foreign(['document_type_id'], 'course_needed_doc_ibfk_2')->references(['id'])->on('document_type')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_needed_doc', function (Blueprint $table) {
            $table->dropForeign('course_needed_doc_ibfk_1');
            $table->dropForeign('course_needed_doc_ibfk_2');
        });
    }
};
