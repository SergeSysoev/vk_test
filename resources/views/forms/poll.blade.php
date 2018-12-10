@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <h3 class="title">{{ $poll ? 'Редактировать' : 'Создать' }} опрос</h3>
    </div>
</div>
<div class="row edit-poll">
    <div class="col-md-12">
        <form role="form" method="{{ $method }}" action="{{ $action }}">
            {{ csrf_field() }}
            @if($customMethod)
                {{method_field($customMethod)}}
            @endif
            <div class="form-group">
                <label for="name">Тема опроса</label>
                <input name="name" type="text" class="form-control" id="name"
                       value="{{ $poll ? $poll->name : old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="answers">Варианты ответов</label>
            </div>
            <div class="form-group answers">
                @if($poll)
                    @foreach($poll->answers as $index => $answer)
                        <div class="row">
                            @if($index == 0)
                                <div class="col-md-12">
                                    <input name="answers[{{ $answer->id }}]" type="text" class="form-control"
                                           id="answers" value="{{ $answer->text }}">
                                </div>
                            @else
                                <div class="col-md-11">
                                    <input name="answers[{{ $answer->id }}]" type="text" class="form-control"
                                           id="answers" value="{{ $answer->text }}">
                                </div>
                                <div class="col-md-1 text-right">
                                    <button type="button" id="remove_answer" class="btn btn-danger">
                                        <i class="glyphicon glyphicon-minus"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <input name="answers[]" type="text" class="form-control" id="answers" required>
                        </div>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button type="button" id="add_answer" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button>
            </div>
            <div class="checkbox">
                <label>
                    <input name="is_public" type="checkbox"
                            {{ ($poll && $poll->is_public) ? ' checked' : '' }}> Публичный?
                </label>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ $poll ? 'Сохранить' : 'Создать' }}
            </button>
        </form>
    </div>
</div>