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
        Schema::create('question_category', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('code', 191)->unique('code');
            $table->string('name', 191);
            $table->string('icon_hex_color', 191)->nullable();
            $table->string('icon_file', 191)->nullable();
            $table->string('traffic_question', 191)->nullable();
            $table->string('traffic_question_corrects', 191)->nullable();
            $table->string('mechanics_question', 191)->nullable();
            $table->string('mechanics_question_corrects', 191)->nullable();
            $table->integer('time_minute')->nullable();
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
        Schema::dropIfExists('question_category');
    }
};
