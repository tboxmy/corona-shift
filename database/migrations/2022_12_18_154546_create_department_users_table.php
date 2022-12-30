<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_users', function (Blueprint $table) {
            $table->id();

            // Postgresql
            // $table->integer('department_id');
            // $table->bigInteger('user_id')->unsigned()->index();
            $table->jsonb('properties')->nullable();
            $table->timestamps();

            // Postgresql
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('department_id')->references('id')->on('departments');

            // Mysql
            $table->foreignId('user_id')->nullable()->consrained('users')->onDelete('set null');
            $table->foreignId('department_id')->nullable()->consrained('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_users');
    }
}
