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
        Schema::table('city', function (Blueprint $table) {
            $table->foreign(['country_id'], 'city_ibfk_1')->references(['id'])->on('country')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('city', function (Blueprint $table) {
            $table->dropForeign('city_ibfk_1');
        });
    }
};
