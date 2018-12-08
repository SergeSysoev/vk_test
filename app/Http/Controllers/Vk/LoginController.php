<?php

namespace App\Http\Controllers\Vk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\City;
use App\User;


class LoginController extends Controller
{
    public function index(Request $request)
    {
		echo $request->get('access_token');
    }
}
