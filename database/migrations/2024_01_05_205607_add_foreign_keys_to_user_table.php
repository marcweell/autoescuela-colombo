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
        Schema::table('user', function (Blueprint $table) {
            $table->foreign(['role_id'], 'user_ibfk_1')->references(['id'])->on('role')->onDelete('CASCADE');
            $table->foreign(['idd_country_id'], 'user_ibfk_3')->references(['id'])->on('country')->onDelete('CASCADE');
            $table->foreign(['city_id'], 'user_ibfk_2')->references(['id'])->on('city')->onDelete('CASCADE');
            $table->foreign(['country_id'], 'user_ibfk_4')->references(['id'])->on('country')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropForeign('user_ibfk_1');
            $table->dropForeign('user_ibfk_3');
            $table->dropForeign('user_ibfk_2');
            $table->dropForeign('user_ibfk_4');
        });
    }
};
