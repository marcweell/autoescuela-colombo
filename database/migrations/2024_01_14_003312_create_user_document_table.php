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
        Schema::create('user_document', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user_id')->index('user_id');
            $table->string('code', 191)->unique('code');
            $table->bigInteger('document_type_id')->index('document_type_id');
            $table->string('file', 400);
            $table->string('file_type', 11)->nullable();
            $table->string('extension', 20)->nullable();
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
        Schema::dropIfExists('user_document');
    }
};
