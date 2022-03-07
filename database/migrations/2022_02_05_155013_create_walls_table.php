<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->on('categories')->onDelete('SET NULL')->onUpdate('SET NULL');
            $table->text('attachment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('walls', function (Blueprint $table) {
            //
        });
    }
}
