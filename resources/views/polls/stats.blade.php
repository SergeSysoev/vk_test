@foreach($poll->answers as $answer)
    <div class="answer answer-{{ $answer->id }}">
        <div class="answer-text">
            {{ $answer->text }}
        </div>
        <div class="pull-right">
            <b>{{ $votes[$answer->id]['percentage'] }}%</b>
        </div>
        <div class="percentage-wrapper">
            <div class="percentage" style="width: {{ $votes[$answer->id]['percentage'] }}%"></div>
        </div>
        {{--<i class="glyphicon glyphicon-ok"></i>--}}
        @if($poll->is_public)
            <span class="users">
                @foreach($votes[$answer->id]['users'] as $key => $user)
                    @if($key < 4)
                        <img src="{{ $user->photo_50 }}" alt="{{ $user->fullName() }}">
                    @endif
                @endforeach
            </span>
        @endif
        <span class="count">
            @if($votes[$answer->id]['count'] > 0)
                {{ \App\Http\Helpers\AmountHelper::ending($votes[$answer->id]['count'], ['голос', 'голоса', 'голосов']) }}
            @endif
        </span>
    </div>
@endforeach