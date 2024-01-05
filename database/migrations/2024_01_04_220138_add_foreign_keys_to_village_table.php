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
        Schema::table('village', function (Blueprint $table) {
            $table->foreign(['city_id'], 'village_ibfk_1')->references(['id'])->on('city')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('village', function (Blueprint $table) {
            $table->dropForeign('village_ibfk_1');
        });
    }
};
