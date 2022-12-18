<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_users', function (Blueprint $table) {
            $table->id();
            $table->integer('shift_id');
            $table->integer('user_id');
            $table->string('description')->nullable();
            $table->string('department_code');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->timestamp('published_at')->nullable();
            $table->integer('published_by')->nullable();
            $table->jsonb('options')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shift_id')->references('id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_users');
    }
}
