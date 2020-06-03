@extends('admin.dashboard.dashboard-master')
@section('title', 'Thêm khoá học')
@section('content')
    <h1 class="template-title">Thêm khoá học</h1>
    @include('admin.components.course-editor')
    @include('admin.components.featured-image-modal')
    @include('admin.components.insert-media-modal')
@endsection
