<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create('ru_RU');
		for($i = 3; $i <= 12; $i++) {
			$countryId = $faker->numberBetween(1, 10);
			DB::table('cities')->insert([
				'id' => $i,
				'title' => $faker->city,
				'country_id' => $countryId,
			]);
			for($j = $i*10; $j < ($i*10)+10; $j++) {
				$userId = $j;
				DB::table('users')->insert([
					'id' => $userId,
					'country_id' => $countryId,
					'city_id' => $i,
					'first_name' => $faker->firstName,
					'last_name' => $faker->lastName,
					'sex' => $faker->numberBetween(1, 3),
				]);
				foreach (range(1,10) as $pollIndex) {
					$pollId = DB::table('polls')->insertGetId([
						'name' => $faker->sentence(),
						'is_public' => $faker->numberBetween(0, 1),
						'user_id' => $userId,
					]);
					foreach (range(1,10) as $answerIndex) {
						$answerId = DB::table('answers')->insertGetId([
							'poll_id' => $pollId,
							'text' => $faker->sentence(),
						]);
					}
				}
			}
		}
	}
}