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
        Schema::table('user_document', function (Blueprint $table) {
            $table->foreign(['document_type_id'], 'user_document_ibfk_1')->references(['id'])->on('document_type')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'user_document_ibfk_2')->references(['id'])->on('user')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_document', function (Blueprint $table) {
            $table->dropForeign('user_document_ibfk_1');
            $table->dropForeign('user_document_ibfk_2');
        });
    }
};
