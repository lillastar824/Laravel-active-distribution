<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->default('');
            $table->string('lastname')->default('');
            $table->string('image')->nullable()->default(null);
            $table->string('email');
            $table->string('password');
            $table->string('remember_token')->nullable()->default(null);;
            $table->string('phone')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('zipcode')->nullable()->default(null);
            $table->date('dob')->nullable()->default(null);
            $table->string('attach_id')->default('');
            $table->string('device_id');
            $table->enum('device_type',['A','I'])->default('A');
            $table->enum('user_type',['N','A'])->default('N');
            $table->string('forget_token')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }






}
