@extends('themes.parent-theme.initialize')
@section('header')
    @include('themes.child-theme.header')
@endsection
@section('content')
    @include('themes.child-theme.archive')
@endsection
@section('footer')
    @include('themes.child-theme.footer')
@endsection
