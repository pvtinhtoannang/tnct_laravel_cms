@extends('themes.parent-theme.initialize')
@section('header')
    @include('themes.child-theme.header')
@endsection
@section('content')

    <iframe src="/read-file" width="100%" height="700px"/>

@endsection
@section('footer')
    @include('themes.child-theme.footer')
@endsection
