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
        Schema::create('user', function (Blueprint $table) {
            $table->bigInteger('id', true)->autoIncrement();
            $table->string('code', 191)->unique('code');
            $table->string('password', 320)->nullable();
            $table->string('names', 191)->nullable();
            $table->string('father_name', 191)->nullable();
            $table->string('mother_name', 191)->nullable();
            $table->string('national_id', 191)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('address')->nullable();
            $table->date('born_date')->nullable();
            $table->bigInteger('question_category_id')->nullable()->index('question_category_id');
            $table->string('driving_course', 150)->nullable();
            $table->string('form_type', 150)->nullable();
            $table->string('passport_file', 300)->nullable();
            $table->string('medical_evaluation_file', 300)->nullable();
            $table->string('photo', 191)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('activation_token', 100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
};
