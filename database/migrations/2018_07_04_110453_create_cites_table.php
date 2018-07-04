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
//            $table->text('name')->nullable();
//
//            $table->integer('year')->nullable();
//                $table->integer('cites_last_year_count')->nullable();
//            $table->integer('cites_last_year_percent')->nullable();
//
//                $table->integer('rank_percent')->nullable();
//            $table->integer('h_index')->nullable();
//
//            $table->text('link_googleScholar')->nullable();
//            $table->text('current_school')->nullable();
//            $table->text('position')->nullable();
//            $table->integer('PhDYear')->nullable();
//            $table->text('PhDSchool')->nullable();
//            $table->integer('years')->nullable();
//            $table->text('first_name')->nullable();
//            $table->text('middle_name')->nullable();
//            $table->text('last_name')->nullable();
//            $table->text('interests')->nullable();
//            $table->text('link_researchGate')->nullable();
//            $table->text('link_academiaEdu')->nullable();
//            $table->text('link_linkedin')->nullable();
//            $table->text('link_twitter')->nullable();
//            $table->text('link_website')->nullable();
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
