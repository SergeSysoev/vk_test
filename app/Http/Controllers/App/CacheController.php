<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function polls()
    {
    	Cache::flush();
    	Cache::forget('polls');

//    	Cache::forever('polls', Poll::orderBy('id', 'desc')->paginate(10));
    }
}
