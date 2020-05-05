@extends('admin.dashboard.dashboard-master')
@section('title', 'Thêm trang mới')
@section('content')
    <h1 class="template-title">Thêm trang mới</h1>
    @include('admin.components.post-editor')
    @include('admin.components.featured-image-modal')
@endsection
