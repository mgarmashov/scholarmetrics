<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            foreach(config('excelColumns')['Current Schools'] as $column){
                if ($column['type'] == 'text'){
                    $table->text($column['dbColumnName'])->nullable();
                }
                if ($column['type'] == 'integer'){
                    $table->integer($column['dbColumnName'])->nullable();
                }

            }
//            $table->integer('rank')->nullable();
//            $table->text('name')->nullable();
//            $table->integer('faculty')->nullable();
//            $table->integer('total')->nullable();
//            $table->integer('median')->nullable();
//            $table->integer('mean')->nullable();
//            $table->text('url')->nullable();
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
        Schema::dropIfExists('schools');
    }
}
