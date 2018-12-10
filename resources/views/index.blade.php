@extends('layouts.app')

@section('content')
    @foreach($polls as $poll)
        <div class="row polls">
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
                        <div class="answer choose-answer" data-href="{{ route('vote.store', $answer->id) }}"
                             data-token="{{ csrf_token() }}">
                            <span>
                                {{ $answer->text }}
                            </span>
                        </div>
                    @endforeach    
                </div>
            </div>
        </div>
    @endforeach
    {{ $polls->links() }}
@endsection