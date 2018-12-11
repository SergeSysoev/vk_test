<?php

namespace App\Http\Controllers\App;

use App\Poll;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Services\PollService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Request;

class StatController extends Controller
{
    public function index($id)
    {
    	$poll = Poll::find($id);
	    $votes = PollService::getVotes($poll);
	    return view('polls.modal')->with([
	    	'votes' => $votes,
		    'poll' => $poll,
	    ]);
    }
    public function country($pollId)
    {
    	$countryId = Request::get('countryId');

	    $poll = Poll::find($pollId);

    	if(!$countryId) {
    		$votes = PollService::getVotes($poll);
	    } else {
		    $usersIds = User::where('country_id', $countryId)->get()->keyBy('id')->keys()->toArray();
		    $filteredUsers = PollService::getUsersAnswersFiltered($usersIds, $poll)->keyBy('answer_id')->keys()->toArray();
		    $votes = PollService::getVotesFiltered($poll, $filteredUsers);
	    }

    	return view('polls.stats')->with([
    		'votes' => $votes,
		    'poll' => $poll,
	    ]);
    }
    public function city($pollId)
    {
    	$cityId = Request::get('cityId');

	    $poll = Poll::find($pollId);

    	if(!$cityId) {
    		$votes = PollService::getVotes($poll);
	    } else {
		    $usersIds = User::where('city_id', $cityId)->get()->keyBy('id')->keys()->toArray();
		    $filteredUsers = PollService::getUsersAnswersFiltered($usersIds, $poll)->keyBy('answer_id')->keys()->toArray();
		    $votes = PollService::getVotesFiltered($poll, $filteredUsers);
	    }

    	return view('polls.stats')->with([
    		'votes' => $votes,
		    'poll' => $poll,
	    ]);
    }
    public function age($pollId)
    {
    	$age = Request::get('age');

	    $poll = Poll::find($pollId);

    	if(!$age) {
    		$votes = PollService::getVotes($poll);
	    } else {
		    $dayAfter = (new DateTime(Carbon::now()))->modify('-'.$age.' years')->getTimestamp();
		    $usersIds = User::where([['bdate', '<', $dayAfter]])->get()->keyBy('id')->keys()->toArray();
		    $filteredUsers = PollService::getUsersAnswersFiltered($usersIds, $poll)->keyBy('answer_id')->keys()->toArray();
		    $votes = PollService::getVotesFiltered($poll, $filteredUsers);
	    }

    	return view('polls.stats')->with([
    		'votes' => $votes,
		    'poll' => $poll,
	    ]);
    }
    public function sex($pollId)
    {
    	$sex = Request::get('sex');

	    $poll = Poll::find($pollId);

    	if(!$sex) {
    		$votes = PollService::getVotes($poll);
	    } else {
		    $usersIds = User::where('sex', (string)$sex)->get()->keyBy('id')->keys()->toArray();
		    $filteredUsers = PollService::getUsersAnswersFiltered($usersIds, $poll)->keyBy('answer_id')->keys()->toArray();
		    $votes = PollService::getVotesFiltered($poll, $filteredUsers);
	    }

    	return view('polls.stats')->with([
    		'votes' => $votes,
		    'poll' => $poll,
	    ]);
    }
}
