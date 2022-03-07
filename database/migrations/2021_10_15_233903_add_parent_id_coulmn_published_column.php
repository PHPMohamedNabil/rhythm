<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdCoulmnPublishedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages',function($table){
                 
              //   $table->tinyInteger('published')->default(0);
                 $table->unsignedBigInteger('page_id')->nullable();
                 $table->foreign('page_id')->references('id')->on('pages')->onDelete('SET NULL')->onUpdate('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
