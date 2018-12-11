<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Answer;
use Illuminate\Support\Facades\DB;
use App\Http\Services\PollService;

class VoteController extends Controller
{
    public function vote($id)
    {
    	$poll = Answer::find($id)->poll;
    	DB::table('answer_user')->insert([
    		'answer_id' => $id,
    		'poll_id' => $poll->id,
		    'user_id' => session('user_id'),
	    ]);

    	$poll->fresh();

		$answers = PollService::getVotes($poll);

    	return $answers;
    }

    public function cancel($id)
    {
	    return DB::table('answer_user')->where('user_id', '=', session('user_id'))->where('poll_id', '=', $id)->delete();
    }
}
