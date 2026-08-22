@extends('layouts.app')

@section('content')
    @if(isset($services) && $services->count())
        @include('home-dynamic')
    @else
        @include('home-content')
    @endif
@endsection
