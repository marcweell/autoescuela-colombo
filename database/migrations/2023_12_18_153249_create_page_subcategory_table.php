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
        Schema::create('page_subcategory', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('code', 191)->unique('code');
            $table->text('title');
            $table->longText('description');
            $table->string('image', 191)->nullable();
            $table->bigInteger('page_id')->index('page_id');
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
        Schema::dropIfExists('page_subcategory');
    }
};
