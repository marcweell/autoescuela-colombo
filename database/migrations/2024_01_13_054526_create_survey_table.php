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
        Schema::create('survey', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('code', 191)->unique('code');
            $table->string('logo', 300)->nullable();
            $table->bigInteger('survey_category_id')->index('survey_category_id');
            $table->bigInteger('course_id')->index('course_id');
            $table->bigInteger('language_id')->nullable()->index('language_id');
            $table->string('name', 191);
            $table->text('description')->nullable();
            $table->text('long_description')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('footer', 191)->nullable();
            $table->string('font', 191)->nullable();
            $table->string('bg_image', 191)->nullable();
            $table->string('bg_color', 191)->nullable();
            $table->string('text_color', 191)->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('survey');
    }
};
