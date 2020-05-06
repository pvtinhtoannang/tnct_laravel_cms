@extends('admin.dashboard.dashboard-master')
@section('title', 'Chỉnh sửa bài viết')
@section('content')
    <h1 class="template-title">Chỉnh sửa bài viết</h1>
    @include('admin.components.post-editor')
    @include('admin.components.featured-image-modal')
    @include('admin.components.insert-media-modal')
@endsection
