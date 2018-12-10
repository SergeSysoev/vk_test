<?php

namespace App\Http\Controllers\Vk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use App\Http\Services\UserService;

class LoginController extends Controller
{
    public function index(Request $request)
    {
	    $client = new GuzzleHttp\Client();
	    try {
		    $code = $request->get('code');
		    $params = [
			    'client_id' => config('vk.app_id'),
			    'client_secret' => config('vk.app_secret_key'),
			    'redirect_uri' => route('vk.login'),
			    'code' => $code,
		    ];
		    $response = $client->request('GET', 'https://oauth.vk.com/access_token', ['query' => $params]);
		    $response = json_decode($response->getBody()->getContents());
		    $user = UserService::store($response);
		    session([
		    	'user_id' => $user['id'],
			    'user_name' => $user['first_name'],
			    'access_token' => $response->access_token,
			    'avatar' => $user['photo_50'],
		    ]);
		    return redirect()->route('home');
	    } catch (RequestException $e) {
	    	$error = 'Unknown error';
		    if ($e->hasResponse()) {
			    $error = $e->getResponse()->getBody()->getContents();
		    }
		    return view('error')->with(['error' => json_decode($error)->error_description]);
	    }
    }
}
