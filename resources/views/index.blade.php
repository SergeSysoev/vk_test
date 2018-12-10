@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach(App\Poll::orderBy('id', 'desc')->get() as $poll)
            <div class="col-md-6 poll">
                {{ $poll->id }}
            </div>
        @endforeach
    </div>
@endsection