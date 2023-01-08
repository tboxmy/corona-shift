<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('region')->nullable();
            $table->boolean('is_shift')->default(false);
            $table->boolean('is_active')->default(false);
            $table->bigInteger('manager_id')->unsigned()->index()->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->jsonb('properties')->nullable();
            $table->timestamps();
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
