<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12/11/18
 * Time: 11:10 AM
 */

namespace App\Http\Services;

use App\Poll;
use Illuminate\Support\Facades\DB;

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
			$answers[$key]['percentage'] = $totalAnswers ? round(($answers[$key]['count'] / $totalAnswers) * 100, 2) : 0;
		}
		return $answers;
	}

	public static function getVotesFiltered(Poll $poll, $filters)
	{
		$answers = [];

		$totalAnswers = 0;

		foreach ( $poll->answers as $answer ) {
			if(in_array($answer->id, $filters)) {
				$answers[$answer->id]['count'] = $answer->users->count();
				$answers[$answer->id]['users'] = $answer->users;
				$totalAnswers += $answer->users->count();
			}
			else {
				$answers[$answer->id]['count'] = 0;
				$answers[$answer->id]['users'] = [];
			}
		}

		foreach ( $answers as $key => $answer ) {
			$answers[$key]['percentage'] = $totalAnswers ? round(($answers[$key]['count'] / $totalAnswers) * 100, 2) : 0;
		}
		return $answers;
	}

	public static function getUserAnswers($userId)
	{
		return DB::table('answer_user')->where('user_id', '=', $userId)->get();
	}

	public static function getUsersAnswersFiltered(array $usersIds, Poll $poll)
	{
		return DB::table('answer_user')->whereIn('user_id', $usersIds)->where('poll_id', '=', $poll->id)->get();
	}

}