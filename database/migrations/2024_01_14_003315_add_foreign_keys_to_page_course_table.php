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
        Schema::table('page_course', function (Blueprint $table) {
            $table->foreign(['page_id'], 'page_course_ibfk_1')->references(['id'])->on('page')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_course', function (Blueprint $table) {
            $table->dropForeign('page_course_ibfk_1');
        });
    }
};
