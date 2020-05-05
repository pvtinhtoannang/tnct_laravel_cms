@extends('admin.dashboard.dashboard-master')
@section('title', 'Cập nhật hồ sơ')
@section('content')
    <h1 class="template-title">Cập nhật hồ sơ</h1>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Cập nhật hồ sơ
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form" method="POST" action="{{route('POST_MY_PROFILE')}}">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group form-group-last">
                            <div class="alert alert-secondary" role="alert">
                                @if(!empty($users_data['email_verified_at']) || $users_data['email_verified_at'] == NULL )
                                    <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                    <div class="alert-text">
                                        Tài khoản chưa được xác thực!
                                    </div>
                                @else
                                    <div class="alert-icon"><i class="flaticon2-protected kt-font-brand"></i></div>
                                    <div class="alert-text">
                                        Tài khoản đã được xác thực!
                                    </div>
                                @endif
                                @if ($message = Session::get('messages'))
                                    <div class="alert-icon"><i class="flaticon-chat-2 kt-font-brand"></i></div>
                                    <div class="alert-text">
                                        {{ $message }}
                                    </div>
                                @endif


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input type="text" id="name" name="name" class="form-control" aria-describedby="emailHelp"
                                   value="{{ $users_data['name'] }}" placeholder="Nhập tên của bạn">
                        </div>
                        <div class="form-group">
                            <label for="email">Địa chỉ email</label>
                            <input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelp"
                                   value="{{ $users_data['email'] }}" placeholder="Nhập địa chỉ email của bạn"/>
                            <span class="form-text text-muted">Nếu bạn thay đổi email. Bạn sẽ nhận được một email xác nhận!</span>
                        </div>
                        <div class="form-group">
                            <label for="InputPassword1">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" id="InputPassword1"
                                   placeholder="Mật khẩu">
                            <span class="form-text text-muted">Mật khẩu có độ dài lớn hơn 8 ký tự và nên bao gồm in hoa và in thường</span>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Cập nhật hồ sơ</button>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection
