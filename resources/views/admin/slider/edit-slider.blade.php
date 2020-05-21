@extends('admin.dashboard.dashboard-master')
@section('title', 'Cài đặt slider')
@section('content')
    <style>
        .slide-image {
            max-width: 100%;
            overflow: hidden;
            max-height: 500px;
            margin-bottom: 15px;
        }

        .slide-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>



    <div id="kt_repeater_1" class="repeater">
        <div class="form-group  row" id="kt_repeater_1">
            <label class="col-lg-1 col-form-label">Slider:</label>
            <div data-repeater-list="" class="col-lg-9">
                @dump($data_content)
{{--                @foreach($data->post_content as $value)--}}
{{--                    @dump($value)--}}
{{--                    <div data-repeater-item class="form-group row align-items-center item-repeater"--}}
{{--                         data-repeat-item="1">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Hình ảnh</label>--}}
{{--                                <div class="slide-image"></div>--}}
{{--                                <div class="custom-file">--}}
{{--                                    <input type="hidden" data-id="" value="" name="slide_id_images" class="id-images">--}}
{{--                                    <button class="btn btn-success btn-choose-file" id="btn-choose-file"--}}
{{--                                            data-repeat="1">--}}
{{--                                        Chọn file--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="d-md-none kt-margin-b-5"></div>--}}
{{--                            <div class="kt-form__group--inline">--}}
{{--                                <div class="kt-form__label">--}}
{{--                                    <label for="title">Liên kết:</label>--}}
{{--                                </div>--}}
{{--                                <div class="kt-form__control">--}}
{{--                                    <input type="url" name="slide_url" class="form-control"--}}
{{--                                           placeholder="Nhập liên kết">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="d-md-none kt-margin-b-5"></div>--}}
{{--                            <div class="kt-form__group--inline">--}}
{{--                                <div class="kt-form__label">--}}
{{--                                    <label for="title">Tiêu đề:</label>--}}
{{--                                </div>--}}
{{--                                <div class="kt-form__control">--}}
{{--                                    <input type="text" name="slide_title" class="form-control"--}}
{{--                                           placeholder="Nhập tiêu đề">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="d-md-none kt-margin-b-10"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

            </div>
            <div class="col-lg-2">
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Đăng</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
                        <button class="btn btn-primary btn-save-slide" data-title="{{ $data->post_title }}"
                                data-name="{{$data->post_name}}" data-id="{{$data->ID}}" type="button">
                            Cập nhật
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-2">
                <label class="kt-form__label"></label>
            </div>
            <div class="col-lg-4">
                <div data-repeater-create="" class="btn btn btn-sm btn-brand btn-pill btn-add-slide-item"><span><i
                                class="la la-plus"></i><span>Thêm slide</span></span>
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.insert-media-modal')
@endsection