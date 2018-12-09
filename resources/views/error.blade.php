@extends('layouts.app')

@section('content')
    <div class="row">
        @if($error)
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            </div>
        @endif
    </div>
@endsection