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
        Schema::create('settings', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name', 400);
            $table->string('code', 300);
            $table->longText('content')->nullable();
            $table->integer('line_height')->default(3);
            $table->enum('content_type', ['plain_text', 'rich_text', 'color', 'number', 'date', 'time', 'file'])->default('plain_text');
            $table->string('filetypes', 300)->nullable();
            $table->string('regex', 300)->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('multiple')->default(false);
            $table->string('child_index', 400)->nullable();
            $table->bigInteger('parent_id')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
