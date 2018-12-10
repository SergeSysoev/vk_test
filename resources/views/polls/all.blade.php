@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('poll.create') }}" class="btn btn-primary mb10">Создать</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Публичный?</th>
                    <th>Действия</th>
                </tr>
                @foreach($polls as $poll)
                    <tr>
                        <td>{{ $poll->id }}</td>
                        <td>{{ $poll->name }}</td>
                        <td>{{ $poll->is_public }}</td>
                        <td>
                            <a href="{{ route('poll.edit', $poll->id) }}" type="button"
                               class="btn btn-default btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('poll.destroy', $poll->id) }}" type="button" data-method="delete"
                               data-token="{{ csrf_token() }}" class="btn btn-danger btn-circle delete-entry">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $polls->links() }}
        </div>
    </div>
@stop