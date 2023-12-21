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
        Schema::create('question', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('code', 191)->unique('code');
            $table->text('question');
            $table->text('answer');
            $table->text('opt_a')->nullable();
            $table->text('opt_b')->nullable();
            $table->text('opt_c')->nullable();
            $table->text('opt_d')->nullable();
            $table->text('opt_e')->nullable();
            $table->text('color');
            $table->string('icon', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->string('course', 191)->nullable();
            $table->string('general_course', 191)->nullable();
            $table->string('type', 191)->nullable();
            $table->bigInteger('question_category_id')->index('question_category_id');
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
        Schema::dropIfExists('question');
    }
};
