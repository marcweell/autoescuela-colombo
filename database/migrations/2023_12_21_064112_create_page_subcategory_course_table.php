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
        Schema::create('page_subcategory_course', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('code', 191)->unique('code');
            $table->string('link_pdf', 191)->nullable();
            $table->string('num_course', 191)->nullable();
            $table->string('course_category', 191)->nullable();
            $table->longText('description');
            $table->bigInteger('page_subcategory_id')->index('page_subcategory_id');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_subcategory_course');
    }
};
