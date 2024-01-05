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
        Schema::table('user_contact', function (Blueprint $table) {
            $table->foreign(['user_id'], 'user_contact_ibfk_2')->references(['id'])->on('user')->onDelete('CASCADE');
            $table->foreign(['contact_type_id'], 'user_contact_ibfk_1')->references(['id'])->on('contact_type')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_contact', function (Blueprint $table) {
            $table->dropForeign('user_contact_ibfk_2');
            $table->dropForeign('user_contact_ibfk_1');
        });
    }
};
