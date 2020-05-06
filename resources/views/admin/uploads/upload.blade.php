@extends('admin.dashboard.dashboard-master')
@section('title', 'Thư viện')
@section('content')
    <h1 class="template-title">Thư viện</h1>
    <ul class="attachments">
        @if(!empty($attachments))
            @foreach($attachments as $file)
                @if($file->meta['meta_value'] !== null)
                    <?php
                    $uploads_url = url('/contents/uploads');
                    $uploads_path = public_path('/contents/uploads');
                    $file_url = $uploads_url . '/' . $file->meta['meta_value'];
                    $file_path = $uploads_path . '/' . $file->meta['meta_value'];
                    ?>
                    @if(file_exists($file_path))
                        <li>
                            <div class="attachment-preview">
                                <div class="thumbnail">
                                    <img
                                        src="{{$file_url}}"
                                        alt="">
                                </div>
                            </div>
                        </li>
                    @endif
                @endif
            @endforeach
        @endif
    </ul>
@endsection
