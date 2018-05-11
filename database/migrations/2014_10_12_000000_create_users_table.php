<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id')->primary();
            $table->string('nickname');
            $table->string('name')->nullable();
            $table->boolean('gender_id')->unsigned();
            $table->uuid('father_id')->nullable();
            $table->uuid('mother_id')->nullable();
            $table->uuid('parent_id')->nullable();
            $table->date('dob')->nullable();
            $table->date('dod')->nullable();
            $table->date('yod')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('job')->nullable();
            $table->string('photo_path')->nullable();
            $table->uuid('manager_id')->nullable();
            $table->rememberToken();
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
