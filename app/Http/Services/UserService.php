<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12/9/18
 * Time: 4:08 PM
 */

namespace App\Http\Services;

use App\User;
use App\Country;
use App\City;
use Carbon\Carbon;
use GuzzleHttp;

class UserService
{
	private static function requestData($data)
	{
		$client = new GuzzleHttp\Client(['base_uri' => config('vk.base_api_uri')]);

		$params = [
			'access_token' => $data->access_token,
			'v' => config('vk.api_version'),
			'user_ids' => $data->user_id,
			'fields' => 'photo_50,country,city,bdate,sex',
		];

		$userData = $client->request('GET', 'users.get', ['query' => $params]);
		$userData = json_decode($userData->getBody()->getContents(), true)['response'][0];

		return $userData;
	}

	public static function store($data)
	{
		$userData = self::requestData($data);

		$countryId = NULL;
		$cityId = NULL;

		if(isset($userData['country'])) {
			Country::firstOrCreate($userData['country']);
			$countryId = $userData['country']['id'];
			if(isset($userData['city'])) {
				$userData['city']['country_id'] = $countryId;
				City::firstOrCreate($userData['city']);
				$cityId = $userData['city']['id'];
			}
		}

		$userData['country_id'] = $countryId;
		$userData['city_id'] = $cityId;
		$userData['sex'] = (string)$userData['sex'];
		$userData['bdate'] = Carbon::createFromFormat('d.m.Y', $userData['bdate'])->timestamp;

		if(!User::find($userData['id'])) {
			User::create($userData);
		}

		return $userData;
	}
}