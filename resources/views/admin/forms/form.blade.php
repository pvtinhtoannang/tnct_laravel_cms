@extends('admin.dashboard.dashboard-master')
@section('title', 'Form')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        <strong>{{ $data->name }}</strong>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="javascript:history.go(-1)" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Quay lại trang trước
                        </a>
                        &nbsp
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
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Số điện thoại</th>
                        <th>Tên công ty</th>
                        <th>Chức vụ</th>
                        <th>Địa chỉ</th>
                        @if($data->id === 1)
                            <th>Khoá học</th>
                        @else
                            <th>Nội dung</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->FormMeta as $item)
                        <tr>
                            <td class="kt-font-bold">{{$item->name}}
                                <div class="nowrap row-actions">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                       title="View">
                                        <i class="la la-eye"></i>
                                    </a>
                                    <a href="#"
                                       class="btn btn-sm btn-clean btn-icon btn-icon-md kt_sweetalert_delete_permission"
                                       title="Xoá">
                                        <i class="la la-trash"></i>
                                    </a>
                                </div>
                            </td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->company_name}}</td>
                            <td>{{$item->position}}</td>
                            <td>{{$item->address}}</td>
                            @if($data->id === 1)
                                <td>{{$item->course}}</td>
                            @else
                                <td>{{$item->content}}</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
@endsection
