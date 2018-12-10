@extends('layouts.app')

@section('content')
    @include('forms.poll',
                ['action' => route('poll.create'), 'method' => 'POST', 'customMethod' => NULL, 'poll' => NULL])
@stop