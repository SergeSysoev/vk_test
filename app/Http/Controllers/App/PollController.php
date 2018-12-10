<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Poll;
use App\Answer;
use App\Http\Requests\StorePollRequest;

class PollController extends Controller
{
	private function getPoll($id)
	{
		return Poll::where([
			['id', '=', $id],
			['user_id', '=', session('user_id')],
		])->firstOrFail();
	}
	public function my()
	{
		return view('polls.all')->with([
			'polls' => Poll::where('user_id', session('user_id'))->paginate(10),
		]);
	}

	public function create()
	{
		return view('polls.create');
	}

	public function store(StorePollRequest $request)
	{
		$request->validated();

		$poll = Poll::create([
			'name' => $request->input('name'),
			'is_public' => $request->input('is_public') == 'on' ? 1 : 0,
			'user_id' => session('user_id'),
		]);

		foreach ( $request->input( 'answers' ) as $answer ) {
			Answer::create([
				'poll_id' => $poll->id,
				'text' => $answer,
			]);
		}

		return redirect(route('polls.my'));
	}

	public function edit($id)
	{
		$poll = $this->getPoll($id);
		return view('polls.edit')->with(['poll' => $poll]);
	}

	public function update($id, StorePollRequest $request)
	{
		$request->validated();

		$poll = $this->getPoll($id);
		$poll->update([
			'name' => $request->input('name'),
			'is_public' => $request->input('is_public') == 'on' ? 1 : 0,
		]);

		$answers = Answer::where([
			['poll_id', '=', $id],
		])->get()->keyBy('id');

		$newAnswers = collect($request->input('answers'));
		$diff = $answers->diffKeys($newAnswers);

		if($diff->count()) {
			foreach ( $diff as $item ) {
				$answers->forget($item->id);
				$item->delete();
			}
		}

		foreach ( $request->input( 'answers' ) as $key => $newAnswer ) {
			if($answers->has($key)) {
				$answers[$key]->update([
					'text' => $newAnswer,
				]);
			} else {
				Answer::create([
					'poll_id' => $id,
					'text' => $newAnswer,
				]);
			}
		}

		return redirect(route('polls.my'));
	}

	public function destroy($id)
	{
		$poll = $this->getPoll($id);

		$poll->delete();

		return redirect(route('polls.my'));
	}
}
