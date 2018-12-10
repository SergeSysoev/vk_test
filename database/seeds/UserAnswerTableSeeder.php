<?php

use Illuminate\Database\Seeder;
use App\User;

class UserAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    foreach ( User::all() as $user ) {

        }
    }
}
