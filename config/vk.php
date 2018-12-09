<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 08.12.18
 * Time: 19:58
 */

return [
	'app_id' => env('VK_APP_ID'),
	'app_secret_key' => env('VK_APP_SECRET_KEY'),
	'base_api_uri' => env('VK_BASE_API_URI', 'https://api.vk.com/method/'),
	'api_version' => env('VK_API_VERSION', '5.92'),
];