@extends('layouts.app')

@section('content')
    @include('forms.poll',
                ['action' => route('poll.update', ['id' => $poll->id]), 'method' => 'POST', 'customMethod' => 'PATCH', 'poll' => $poll])
@stop