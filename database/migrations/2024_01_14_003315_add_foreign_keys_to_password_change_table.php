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
        Schema::table('password_change', function (Blueprint $table) {
            $table->foreign(['user_id'], 'password_change_ibfk_1')->references(['id'])->on('user')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('password_change', function (Blueprint $table) {
            $table->dropForeign('password_change_ibfk_1');
        });
    }
};
