<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couples', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('husband_id');
            $table->uuid('wife_id');
            $table->date('marriage_date')->nullable();
            $table->date('divorce_date')->nullable();
            $table->uuid('manager_id')->nullable();
            $table->timestamps();

            $table->unique(['husband_id', 'wife_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couples');
    }
}
