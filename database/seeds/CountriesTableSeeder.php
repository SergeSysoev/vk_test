<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $faker = Faker::create('ru_RU');
	    foreach (range(2,10) as $index) {
		    DB::table('countries')->insert([
			    'id' => $index,
			    'title' => $faker->country,
		    ]);
	    }
    }
}
