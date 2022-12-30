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

            // Postgresql
            // $table->integer('shift_id');
            // $table->integer('user_id');
            $table->string('description')->nullable();
            $table->integer('department_id');
            $table->string('department_code');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->timestamp('clockin_at')->nullable();
            $table->timestamp('clockout_at')->nullable();
            $table->jsonb('options')->nullable();
            $table->timestamps();
            // Postgresql
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shift_id')->references('id')->on('shifts');

            // Mysql
            $table->foreignId('user_id')->nullable()->consrained('users')->onDelete('set null');
            $table->foreignId('shift_id')->nullable()->consrained('shifts')->onDelete('set null');
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
