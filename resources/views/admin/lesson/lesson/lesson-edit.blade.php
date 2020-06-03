@extends('admin.dashboard.dashboard-master')
@section('title', 'Chỉnh sửa bài học')
@section('content')
    <h1 class="template-title">Chỉnh sửa bài học</h1>
    @include('admin.components.lesson-editor')
    @include('admin.components.insert-file-modal')
@endsection
