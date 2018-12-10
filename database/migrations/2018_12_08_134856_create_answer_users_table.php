<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_user', function (Blueprint $table) {
			$table->integer('poll_id')->unsigned();
			$table->integer('answer_id')->unsigned();
			$table->integer('user_id')->unsigned();

			$table->primary(['poll_id', 'user_id']);
	        $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');
	        $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_user');
    }
}
