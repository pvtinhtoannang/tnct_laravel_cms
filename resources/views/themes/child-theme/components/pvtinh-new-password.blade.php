@extends('themes.parent-theme.initialize')
@section('header')
    @include('themes.child-theme.header')
@endsection
@section('content')
    <section class="pvtinh-new-password">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6" style="margin: auto">
                    <h1 class="text-center title-new-password ">Mật khẩu mới</h1>

                        <input type="hidden" name="token" value="{{ $token  }}">
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới</label>
                            <input type="password" class="form-control" name="password" id="new_password" value="">
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirm">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" name="password_confirm" id="new_password_confirm">
                        </div>
                        <button type="button" class="btn btn-success btn-new-password">
                            Đổi mật khẩu
                        </button>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    @include('themes.child-theme.footer')
@endsection
