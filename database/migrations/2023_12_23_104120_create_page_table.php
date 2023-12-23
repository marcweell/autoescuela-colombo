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
        Schema::create('page', function (Blueprint $table) {
            $table->bigInteger('id', true)->autoIncrement();
            $table->string('code', 191)->unique('code');
            $table->text('title');
            $table->text('subtitle');
            $table->longText('preface');
            $table->longText('description');
            $table->string('icon', 191)->nullable();
            $table->string('hex_color', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->string('video', 191)->nullable();
            $table->string('file', 191)->nullable();
            $table->float('price', 10, 0)->nullable();
            $table->float('price_promo', 10, 0)->nullable();
            $table->bigInteger('page_category_id')->index('page_category_id');
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
        Schema::dropIfExists('page');
    }
};
