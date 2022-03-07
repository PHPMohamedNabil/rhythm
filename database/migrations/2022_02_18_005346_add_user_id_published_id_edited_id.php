<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdPublishedIdEditedId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
             $table->unsignedBigInteger('user_id')->nullable();

            $table->unsignedBigInteger('publisher_id')->nullable();

            $table->unsignedBigInteger('editor_id')->nullable();

            

            $table->foreign('editor_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('SET NULL');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('SET NULL');

            $table->foreign('publisher_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('SET NULL');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
