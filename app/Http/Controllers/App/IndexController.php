<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Poll;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function index()
    {
	    $all = Cache::remember('polls', 10, function() {
		    return Poll::orderBy('id', 'desc')->get();
	    });

	    $page = Input::get('page', 1);
	    $perPage = 10;

	    $data = new LengthAwarePaginator(
		    $all->forPage($page, $perPage), $all->count(), $perPage, $page
	    );

    	return view('index')->with([
    		'polls' => $data,
	    ]);
    }
}
