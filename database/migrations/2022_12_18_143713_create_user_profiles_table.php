<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('users table');
            $table->integer('hourly_rate')->comment('salary rate at lowest currency unit. E.g cents for MYR currency')->default(100);
            $table->string('timezone')->nullable();
            $table->string('currency')->comment('refer to ISO code')->default('MYR');
            $table->text('description')->nullable();
            $table->jsonb('options')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_profiles');
    }
}
