@extends('admin.dashboard.dashboard-master')
@section('title', 'Cập nhật hồ sơ')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <h2 class="template-title">Thêm thành viên mới</h2>
            <form class="kt-form" method="POST" action="{{route('POST_ADD_USER')}}">
                @csrf
                <div class="hidden"></div>
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
                        <label for="name">Họ và tên</label>
                        <input id="name" type="text"
                               name="name" class="form-control"
                               aria-describedby="name"
                               value="{{ old('name') }}"
                               placeholder="Nhập họ và tên, ex: nguyen van a">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email"
                               name="email" class="form-control"
                               aria-describedby="email"
                               value="{{ old('email') }}"
                               placeholder="Nhập email, ex: nguyenvana@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input id="password" type="password"
                               name="password" class="form-control"
                               aria-describedby="email"
                               value="{{ old('password') }}"
                               placeholder="Nhập mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="role_id">Vai trò</label>
                        <select name="role_id" class="form-control" id="role_id">
                            @foreach($dataRole as $value)
                                <option value="{{ $value->id }}">{{ $value->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
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
                                Danh sách thành viên
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <a href="javascript:history.go(-1)" class="btn btn-clean btn-icon-sm">
                                    <i class="la la-long-arrow-left"></i>
                                    Trở lại trang trước
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <table class="table table-striped table-hover tnct-table" id="permission">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataUsers as $key => $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td class="kt-font-bold">{{$value->name}}
                                        <div class="nowrap row-actions">
                                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                               title="View">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a href="javascript:;"
                                               class="btn btn-edit-user btn-sm btn-clean btn-icon btn-icon-md"
                                               title="Chỉnh sửa" data-toggle="modal" data-id="{{ $value->id }}"
                                               data-target="#kt_modal_update_users">
                                                <i class="la la-edit"></i>
                                            </a>
                                            <a href="#"
                                               class="btn btn-sm btn-clean btn-icon btn-icon-md kt_sweetalert_delete_permission"
                                               title="Xoá">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{$value->email}}</td>
                                    <td>@foreach($value->roles as $role) {{ $role->description.' ' }}  @endforeach</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--begin::Modal-->
                <form class="kt-form" method="POST" action="{{route('UPDATE_USER_BY_LIST')}}">
                    <div class="modal fade" id="kt_modal_update_users" tabindex="-1" role="dialog"
                         aria-labelledby="modalUpdatePermission" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateUserLabelHeading">Cập nhật thành viên</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <div class="hidden"></div>
                                    <div class="kt-portlet__body">
                                        <input type="hidden" id="update_id" value="" name="update_id">
                                        <div class="form-group">
                                            <label for="update_name">Họ và tên</label>
                                            <input id="update_name" type="text"
                                                   name="name" class="form-control"
                                                   aria-describedby="name"
                                                   value=""
                                                   placeholder="Nhập họ và tên, ex: nguyen van a">
                                        </div>
                                        <div class="form-group">
                                            <label for="update_email">Email</label>
                                            <input id="update_email" type="email"
                                                   name="email" class="form-control"
                                                   aria-describedby="email"
                                                   value=""
                                                   placeholder="Nhập email, ex: nguyenvana@gmail.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="update_password">Mật khẩu: (để trống nếu không cập nhật)</label>
                                            <input id="update_password" type="password"
                                                   name="password" class="form-control"
                                                   aria-describedby="email"
                                                   value=""
                                                   placeholder="Nhập email, ex: nguyenvana@gmail.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="update_role_id">Vai trò</label>
                                            <select name="role_id" class="form-control" id="update_role_id">
                                                @foreach($dataRole as $value)
                                                    <option value="{{ $value->id }}">{{ $value->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="" id="update_id" name="id">
                                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Đóng
                                    </button>
                                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!--end::Modal-->
            </div>
            <!-- end:: Content -->
        </div>
    </div>
@endsection

