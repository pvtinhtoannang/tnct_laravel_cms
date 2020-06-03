@extends('admin.dashboard.dashboard-master')
@section('title', 'Cài đặt slider')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Danh sách slider
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="javascript:history.go(-1)" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Trở lại trang trước
                        </a>
                        <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal"
                                data-target="#modalAddSlide" aria-haspopup="true">
                            <i class="flaticon2-plus"></i> Thêm slider
                        </button>
                        <form action="{{route('ADD_NEW_SLIDER')}}" method="POST">
                            @csrf
                            <div class="modal fade show" id="modalAddSlide" tabindex="-1" role=""
                                 aria-labelledby="exampleModalLabel" aria-modal="false">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm slide</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Tên slide</label>
                                                <input type="text" name="post_title" id="name" class="form-control"
                                                       placeholder="Nhập tên slide">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="post_type" value="slider">
                                            <input type="hidden" name="post_status" value="publish">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <table class="table table-striped table-hover tnct-table" id="permission">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_slider as $slider)
                        <tr>
                            <td>{{ $slider->ID }}</td>
                            <td class="kt-font-bold">{{ $slider->post_title }}
                                <div class="nowrap row-actions">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                       title="View">
                                        <i class="la la-eye"></i>
                                    </a>
                                    <a href="{{ route('EDIT_SLIDER', $slider->ID) }}"
                                       class="btn btn-edit-user btn-sm btn-clean btn-icon btn-icon-md"
                                       title="Chỉnh sửa">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="#"
                                       class="btn btn-sm btn-clean btn-icon btn-icon-md kt_sweetalert_delete_permission"
                                       title="Xoá">
                                        <i class="la la-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection