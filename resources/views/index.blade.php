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
                        <button type="button" class="btn btn-link cancel-vote"
                                data-href="{{ route('vote.cancel', $poll->id) }}">
                            Отменить голос
                        </button>
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
                            <div class="answer {{ isset($answers[$answer->id]) ? 'chosen' : '' }} answer-{{ $answer->id }}"
                                 data-href="{{ route('vote.store', $answer->id) }}"
                                 data-id="{{ $answer->id }}">
                                <div class="percentage" style="width: {{ $pollAnswers[$answer->id]['percentage'] }}%"></div>
                                <span class="answer-text">
                                    {{ $answer->text }}
                                    <span class="count">
                                        {{ $pollAnswers[$answer->id]['count'] > 0 ? '('.$pollAnswers[$answer->id]['count'].')' : '' }}
                                    </span>
                                </span>
                                <i class="glyphicon glyphicon-ok"></i>
                                <b>{{ $pollAnswers[$answer->id]['percentage'] }}%</b>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="poll">
                    <div class="header">
                        <button type="button" class="btn btn-link cancel-vote"
                                data-href="{{ route('vote.cancel', $poll->id) }}">
                            Отменить голос
                        </button>
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
                                     data-id="{{ $answer->id }}">
                                    <div class="percentage"></div>
                                    <span class="answer-text">
                                        {{ $answer->text }}
                                        <span class="count"></span>
                                    </span>
                                    <i class="glyphicon glyphicon-ok"></i>
                                    <b></b>
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