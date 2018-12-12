<div class="modal fade" id="statsModal" tabindex="-1" role="dialog" aria-labelledby="statsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statsModalLabel">{{ $poll->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Все варианты</a>
                    </li>
                @foreach($poll->answers as $answer)
                    <li class="nav-item">
                        <a class="nav-link" id="pills-{{ $answer->id }}-tab" data-toggle="pill" href="#pills-{{ $answer->id }}" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $answer->text }}</a>
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="modal-body stats">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        @include('polls.stats')
                    </div>
                    @foreach($poll->answers as $answer)
                        <div class="tab-pane fade" id="pills-{{ $answer->id }}" role="tabpanel" aria-labelledby="pills-{{$answer->id}}-tab">
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
                                        @foreach($answer->users as $key => $user)
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
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-4">
                    <b>Страна и город</b>
                    <select class="filter" name="country_id" id="country" data-href="{{ route('stats.filter', $poll->id) }}"
                        data-href-cities="{{ route('cities.get') }}">
                        <option value="0">
                            Страна
                        </option>
                        @foreach(\App\Country::all() as $country)
                            <option value="{{ $country->id }}">
                                {{ $country->title }}
                            </option>
                        @endforeach
                    </select>
                    <select class="filter" name="city_id" id="city" disabled data-href="{{ route('stats.filter', $poll->id) }}">
                        <option value="0">
                            Город
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <b>Возраст</b>
                    <br>
                    <input class="filter" type="radio" name="bdate" id="bdate" value="0" data-href="{{ route('stats.filter', $poll->id) }}"> Любой
                    <br>
                    <input class="filter" type="radio" name="bdate" id="bdate" value="17" data-href="{{ route('stats.filter', $poll->id) }}"> Старше 17 лет
                    <br>
                    <input class="filter" type="radio" name="bdate" id="bdate" value="35" data-href="{{ route('stats.filter', $poll->id) }}"> Старше 35 лет
                </div>
                <div class="col-md-4">
                    <b>Пол</b>
                    <br>
                    <input class="filter" type="radio" name="sex" id="sex" value="0" data-href="{{ route('stats.filter', $poll->id) }}"> Любой
                    <br>
                    <input class="filter" type="radio" name="sex" id="sex" value="1" data-href="{{ route('stats.filter', $poll->id) }}"> Женский
                    <br>
                    <input class="filter" type="radio" name="sex" id="sex" value="2" data-href="{{ route('stats.filter', $poll->id) }}"> Мужской
                </div>
            </div>
        </div>
    </div>
</div>