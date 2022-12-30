<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeoffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeoffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            // Postgresql
            // $table->integer('timeoff_type_id');
            // $table->integer('user_id');
            $table->date('date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->nullable();
            $table->timestamps();
            
            // Postgresql
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('timeoff_type_id')->references('id')->on('timeoff_types');

            // Mysql
            $table->foreignId('user_id')->nullable()->consrained('users')->onDelete('set null');
            $table->foreignId('timeoff_type_id')->nullable()->consrained('timeoff_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timeoffs');
    }
}
