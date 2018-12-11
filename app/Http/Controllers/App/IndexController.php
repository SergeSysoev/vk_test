<?php

namespace App\Http\Controllers\App;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Services\PollService;
use App\Poll;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

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

	    $answers = PollService::getUserAnswers(session('user_id'));

	    $pollKeys = $answers->keyBy('poll_id')->keys()->toArray();
	    $answersKeys = $answers->keyBy('answer_id');

    	return view('index')->with([
    		'polls' => $data,
    		'answers' => $answersKeys,
    		'pollKeys' => $pollKeys,
	    ]);
    }

    public function cities()
    {
    	$country = Country::findOrFail(Request::get('countryId'));
    	return $country->cities;
    }
}
