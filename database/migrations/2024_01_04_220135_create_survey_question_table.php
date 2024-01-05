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
        Schema::create('survey_question', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('code', 191)->unique('code');
            $table->bigInteger('survey_id')->index('survey_id');
            $table->text('question')->nullable();
            $table->enum('question_type', ['single-choice-radio', 'multiple-choice', 'open-ended-single', 'best-worst'])->nullable();
            $table->double('ponctuation')->nullable();
            $table->integer('_lines')->default(3);
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
        Schema::dropIfExists('survey_question');
    }
};
