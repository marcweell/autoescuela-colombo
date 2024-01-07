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
        Schema::create('course', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('course_category_id')->nullable()->index('course_category_id');
            $table->string('code', 191)->unique('code');
            $table->string('name', 191);
            $table->string('logo', 191)->nullable();
            $table->string('cover_photo', 191)->nullable();
            $table->float('price', 10, 0)->nullable();
            $table->float('price_promo', 10, 0)->nullable();
            $table->bigInteger('currency_id')->nullable();
            $table->longtext('description')->nullable();
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
        Schema::dropIfExists('course');
    }
};
