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
        Schema::table('page_subcategory_course', function (Blueprint $table) {
            $table->foreign(['page_subcategory_id'], 'page_subcategory_course_ibfk_1')->references(['id'])->on('page_subcategory')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_subcategory_course', function (Blueprint $table) {
            $table->dropForeign('page_subcategory_course_ibfk_1');
        });
    }
};
