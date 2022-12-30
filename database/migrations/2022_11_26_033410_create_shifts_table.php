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
            $table->string('description')->nullable();
            // Postgresql
            // $table->integer('shift_type_id');            
            $table->integer('parent_id')->nullable();
            $table->integer('total_pax')->unsigned()->default(1);
            $table->integer('region_id')->default(0)->comment('Shift region coverage where 0=All regions');
            $table->timestamp('start')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('published_at')->nullable();
            $table->integer('published_by')->nullable();
            $table->jsonb('options')->nullable();
            $table->timestamps();
            // Postgresql
            // $table->foreign('parent_id')->references('id')->on('shifts')->onDelete('cascade');
            // $table->foreign('shift_type_id')->references('id')->on('shift_types')->onDelete('cascade');

            // Mysql
            $table->foreignId('shift_type_id')->nullable()->constrained('shift_types')->onDelete('set null');
            
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
