<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('percent')->nullable();
            $table->integer('higher_num')->nullable();
            $table->integer('position_id')->nullable();
            $table->text('position_name')->nullable();
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
        Schema::dropIfExists('position_ranks');
    }
}
