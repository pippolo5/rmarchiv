<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaordPollAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_poll_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poll_id');
            $table->string('title');
            $table->integer('user_id');
            $table->timestamps();

            $table->index('poll_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_poll_answers');
    }
}
