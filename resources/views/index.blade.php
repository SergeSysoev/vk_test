@extends('layouts.app')

@section('content')
    <div class="polls">
        @foreach($polls as $poll)
            @if(in_array($poll->id, $pollKeys))
                @php
                $pollAnswers = \App\Http\Services\PollService::getVotes($poll);
                @endphp
                <div class="poll answered">
                    <div class="header">
                        <h3>
                            {{ $poll->name }}
                        </h3>
                        <p>
                            {{ $poll->user->fullName() }}
                        </p>
                        <p>
                            {{ $poll->is_public ? 'Публичный ' : 'Анонимный ' }} опрос
                        </p>
                    </div>
                    <div class="body">
                        @foreach($poll->answers as $answer)
                            <div class="answer {{ isset($answers[$answer->id]) ? 'chosen' : '' }} answer-{{ $answer->id }}">
                                <div class="progress" style="width: {{ $pollAnswers[$answer->id]['percentage'] }}%"></div>
                                <span>
                                    {{ $answer->text }}
                                </span>
                                <b>{{ $pollAnswers[$answer->id]['percentage'] }}%</b>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="poll">
                    <div class="header">
                        <h3>
                            {{ $poll->name }}
                        </h3>
                        <p>
                            {{ $poll->user->fullName() }}
                        </p>
                        <p>
                            {{ $poll->is_public ? 'Публичный ' : 'Анонимный ' }} опрос
                        </p>
                    </div>
                    <div class="body">
                        @foreach($poll->answers as $answer)
                            @if(isset($answers[$answer->id]))
                            @else
                                <div class="answer choose-answer answer-{{ $answer->id }}"
                                     data-href="{{ route('vote.store', $answer->id) }}"
                                     data-token="{{ csrf_token() }}">
                                    <div class="progress" style="width: 50%"></div>
                                    <span>
                                {{ $answer->text }}
                            </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    {{ $polls->links() }}
@endsection