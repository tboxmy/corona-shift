<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('shift_type_id');
            $table->integer('parent_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('start')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->jsonb('options')->nullable();
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
        Schema::dropIfExists('shifts');
    }
}
