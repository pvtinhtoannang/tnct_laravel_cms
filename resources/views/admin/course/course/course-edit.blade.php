@extends('admin.dashboard.dashboard-master')
@section('title', 'Chỉnh sửa khoá học')
@section('content')
    <h1 class="template-title">Chỉnh sửa khoá học</h1>
    @include('admin.components.course-editor')
    @include('admin.components.featured-image-modal')
    @include('admin.components.insert-media-modal')
@endsection
