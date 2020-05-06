@extends('admin.errors.error-master')
@section('title', 'Lỗi')
@section('content')
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v5"
             style="background-image: url(/assets/media/error/bg5.jpg);">
            <div class="kt-error_container">
                @if(!isset($error_responses))
                    <span class="kt-error_title">
						<h1>Oops!</h1>
					</span>
                    <p class="kt-error_subtitle">
                    </p>
                    <p class="kt-error_description">
                        Đã có lỗi xãy ra.<br>
                        Vui lòng kiểm tra lại!<br>
                    </p>
                @else
                    <span class="kt-error_title">
						<h1>{{$error_responses['title']}}</h1>
					</span>
                    <p class="kt-error_subtitle">
                        {{$error_responses['sub_title']}}
                    </p>
                    <p class="kt-error_description">
                        {{$error_responses['description']}}
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
