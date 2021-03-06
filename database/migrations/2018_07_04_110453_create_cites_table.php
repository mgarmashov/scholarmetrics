<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cites', function (Blueprint $table) {
            $table->increments('id');
            $table->text('shortlink')->nullable();
            foreach(config('excelColumns')['Cites'] as $column){
                if ($column['type'] == 'text'){
                    $table->text($column['dbColumnName'])->nullable();
                }
                if ($column['type'] == 'integer'){
                    $table->integer($column['dbColumnName'])->nullable();
                }

            }
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
        Schema::dropIfExists('cites');
    }
}
