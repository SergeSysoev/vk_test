<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12/11/18
 * Time: 11:10 AM
 */

namespace App\Http\Services;

use App\Poll;

class PollService
{
	public static function getVotes(Poll $poll)
	{
		$answers = [];

		$totalAnswers = 0;

		foreach ( $poll->answers as $answer ) {
			$answers[$answer->id]['count'] = $answer->users->count();
			$answers[$answer->id]['users'] = $answer->users;
			$totalAnswers += $answer->users->count();
		}

		foreach ( $answers as $key => $answer ) {
			$answers[$key]['percentage'] = round(($answers[$key]['count'] / $totalAnswers) * 100, 2);
		}
		return $answers;
	}

}