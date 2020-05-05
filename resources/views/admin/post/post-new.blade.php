@extends('admin.dashboard.dashboard-master')
@section('title', 'Thêm bài viết')
@section('content')
    <h1 class="template-title">Thêm bài viết</h1>
    @include('admin.components.post-editor')
    @include('admin.components.featured-image-modal')
    @include('admin.components.insert-media-modal')
@endsection
