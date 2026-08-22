@extends('layouts.app')

@section('title', $title)

@section('content')
    @include('pages.'.$view)
@endsection
