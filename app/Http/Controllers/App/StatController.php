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

    public function filter($pollId)
    {
    	$filters = Request::get('filters') ?? [];
	    $poll = Poll::find($pollId);

	    if(isset($filters['bdate'])) {
		    $dayAfter = (new DateTime(Carbon::now()))->modify('-'.$filters['bdate'].' years')->getTimestamp();
		    $users = User::where([['bdate', '<', $dayAfter]])->get();
		    unset($filters['bdate']);
	    } else {
		    $users = User::all();
	    }

	    if(isset($filters['city_id']) && !isset($filters['country_id'])) {
	    	unset($filters['city_id']);
	    }

	    foreach ( $filters as $filter => $value ) {
		    $users = $users->where($filter, $value);
    	}

	    $usersIds = $users->keyBy('id')->keys()->toArray();

	    if(!isset($filters)) {
		    $votes = PollService::getVotes($poll);
	    } else {
		    $filteredUsers = PollService::getUsersAnswersFiltered($usersIds, $poll)->keyBy('answer_id')->keys()->toArray();
		    $votes = PollService::getVotesFiltered($poll, $filteredUsers, $usersIds);
	    }

	    return view('polls.stats')->with([
		    'votes' => $votes,
		    'poll' => $poll,
	    ]);
    }
}
