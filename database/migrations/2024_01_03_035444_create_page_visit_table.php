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
        Schema::create('page_visit', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('route_name', 400)->nullable();
            $table->string('url', 400)->nullable();
            $table->string('ip', 100)->nullable();
            $table->string('browser', 191)->nullable();
            $table->string('device', 191)->nullable();
            $table->string('user_agent', 191)->nullable();
            $table->string('sessionid', 191)->nullable();
            $table->float('latiutde', 10, 0)->nullable();
            $table->float('longitude', 10, 0)->nullable();
            $table->bigInteger('user_id')->nullable()->index('user_id');
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
        Schema::dropIfExists('page_visit');
    }
};
