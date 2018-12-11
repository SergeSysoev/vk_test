<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Poll;
use App\Answer;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\DB;
use App\Http\Services\PollService;

class VoteController extends Controller
{
    public function index()
    {
    	$poll = Poll::find(1000);
	    foreach ( $poll->answers as $answer ) {
		    VarDumper::dump($answer->users);
    	}
    }

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
}
