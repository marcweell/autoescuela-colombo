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
        Schema::create('site_menu', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name', 400);
            $table->string('code', 191)->unique('code');
            $table->bigInteger('parent_menu_id')->nullable();
            $table->string('route', 400)->nullable();
            $table->string('uri', 400)->nullable();
            $table->integer('order_index')->nullable()->default(0);
            $table->enum('prefer', ['route', 'uri'])->default('route');
            $table->string('icon_class', 100)->nullable();
            $table->enum('target', ['ajax', 'parent', '_blank'])->default('parent');
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
        Schema::dropIfExists('site_menu');
    }
};
