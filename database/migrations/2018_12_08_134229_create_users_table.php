<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\UserSex;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('first_name');
            $table->string('screen_name')->nullable();
            $table->string('last_name');
            $table->integer('city_id')->unsigned()->nullable();
            $table->enum('sex', [UserSex::Unknown, UserSex::Female, UserSex::Male]);
            $table->string('bdate')->nullable();
            $table->string('avatar')->nullable();

            $table->primary('id');
	        $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
