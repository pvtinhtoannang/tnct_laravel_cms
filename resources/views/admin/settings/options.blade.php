@extends('admin.dashboard.dashboard-master')
@section('title', 'Cài đặt tổng quan')
@section('content')

    <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-brand" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#kt_tabs_9_1" role="tab"><i
                    class="flaticon-cogwheel-1"></i>
                Cài đặt tổng quan</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tabs_9_3" role="tab"><i class="flaticon-layers"></i>
                Quản lý tuỳ chọn</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="kt_tabs_9_1" role="tabpanel">
            <h1 class="template-title">Tuỳ chọn tổng quan</h1>

            <form class="kt-form" method="POST" action="{{route('POST_OPTION_GENERAL')}}">
                @csrf
                <div class="kt-portlet__body">
                    <div class="form-group form-group-last">
                        @if ($message = Session::get('messages'))
                            <div class="alert alert-secondary" role="alert">
                                <div class="alert-icon"><i class="flaticon-chat-2 kt-font-brand"></i></div>
                                <div class="alert-text">
                                    {{ $message }}
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            @foreach($options as $option)
                                <div class="form-group">
                                    <label for="{{ $option['option_name'] }}">{{ $option['option_label'] }}</label>
                                    @if($option['option_type']==='text' || $option['option_type']==='url' || $option['option_type']==='email' || $option['option_type']==='number')
                                        <input id="{{ $option['option_name'] }}" type="{{ $option['option_type'] }}"
                                               name="option[][{{ $option['option_name'] }}]" class="form-control"
                                               aria-describedby="{{ $option['option_name'] }}"
                                               value="{{ $option['option_value'] }}"
                                               placeholder="Nhập {{  $option['option_label'] }}">
                                    @elseif ($option['option_type']=='textarea')
                                        <textarea name="{{ $option['option_name'] }}" id="{{ $option['option_name'] }}"
                                                  cols="30" rows="10" class="form-control"></textarea>
                                    @else

                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="col-xs-12 col-md-6">

                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="kt_tabs_9_3" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h2 class="template-title">Thêm tuỳ chọn mới</h2>
                    <form class="kt-form" method="POST" action="{{route('ADD_OPTION_GENERAL')}}">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group form-group-last">
                                @if ($message = Session::get('messages'))
                                    <div class="alert alert-secondary" role="alert">
                                        <div class="alert-icon"><i class="flaticon-chat-2 kt-font-brand"></i></div>
                                        <div class="alert-text">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="option_label">Tiêu đề</label>
                                <input required id="option_label" type="text"
                                       name="option_label" class="form-control"
                                       aria-describedby="option_label"
                                       value="{{ old('option_label') }}"
                                       placeholder="Nhập tiêu đề, ex: Tên website">
                            </div>
                            <div class="form-group">
                                <label for="option_value">Nội dung option</label>
                                <input required id="option_value" type="text"
                                       name="option_value" class="form-control"
                                       aria-describedby="option_value"
                                       value="{{ old('option_value') }}"
                                       placeholder="Nhập tiêu đề, ex: Công Ty TNHH DỊCH VỤ CÔNG NGHỆ TOÀN NĂNG - CHI NHÁNH CẦN THƠ">
                            </div>
                            <div class="form-group">
                                <label for="option_name">Slug</label>
                                <input required id="option_name" type="text"
                                       name="option_name" class="form-control"
                                       aria-describedby="option_name"
                                       value="{{ old('option_name') }}"
                                       placeholder="Slug viết không dấu và có dấu _ ở dưới, ex: tieu_de">
                            </div>
                            <div class="form-group">
                                <label for="option_type">Loại option</label>
                                <select class="form-control" name="option_type" id="option_type">
                                    <option value="text">Text</option>
                                    <option value="url">Đường dẫn</option>
                                    <option value="email">Email</option>
                                    <option value="number">Số</option>
                                    <option value="textarea">Textarea</option>
                                </select>
                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-md-8">

                    <!-- begin:: Content -->
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                    <h3 class="kt-portlet__head-title">
                                        Danh sách các tuỳ chọn
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">
                                        <a href="javascript:history.go(-1)" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Quay lại trang trước
                                        </a>
                                        &nbsp;

                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <!--begin: Search Form -->
                                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                    <div class="kt-input-icon kt-input-icon--left">
                                                        <input type="text" class="form-control"
                                                               placeholder="Tìm kiếm..."
                                                               id="generalSearch">
                                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-hover" id="permission">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Nhãn</th>
                                        <th>Giá trị</th>
                                        <th>Loại</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($options as $option)
                                        <tr>
                                            <td>{{$option->id}}</td>
                                            <td class="kt-font-bold">{{ $option['option_name'] }}
                                                <div class="nowrap row-actions">
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="View">
                                                        <i class="la la-eye"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       class="btn btn-edit-permission btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="Chỉnh sửa" data-toggle="modal" data-id="{{ $option->id }}"
                                                       data-target="#kt_modal_update_permission_settings">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a href="#"
                                                       class="btn btn-sm btn-clean btn-icon btn-icon-md kt_sweetalert_delete_permission"
                                                       title="Xoá">
                                                        <i class="la la-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{$option->option_label}}</td>
                                            <td>{{$option->option_value}}</td>
                                            <td>{{$option->option_type}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>

                    <!-- end:: Content -->
                </div>
            </div>
        </div>
    </div>

@endsection
