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
        Schema::create('user', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('code', 191)->unique('code');
            $table->string('password', 80)->nullable();
            $table->string('photo', 191)->nullable();
            $table->string('name', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->string('father_name', 191)->nullable();
            $table->string('mother_name', 191)->nullable();
            $table->bigInteger('country_id')->nullable()->index('country_id');
            $table->bigInteger('idd_country_id')->nullable()->index('idd_country_id');
            $table->bigInteger('city_id')->nullable()->index('city_id');
            $table->string('phone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('address')->nullable();
            $table->date('born_date')->nullable();
            $table->text('otp')->nullable();
            $table->string('national_id', 191)->nullable();
            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('academic_degree_id')->nullable();
            $table->bigInteger('role_id')->nullable()->index('role_id');
            $table->enum('type', ['admin', 'user'])->default('user');
            $table->boolean('active')->default(true);
            $table->boolean('approved')->default(false);
            $table->string('activation_token', 100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
};
