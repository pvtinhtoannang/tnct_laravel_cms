<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="account-form">
                    <div class="left-form">
                        <a class="btn btn-link btn-facebook" href="{{ URL::to('auth/facebook') }}">
                            <i class="fa fa-facebook-official" aria-hidden="true"></i> Đăng nhập bằng Facebook
                        </a>
                        <a class="btn btn-link btn-google" href="{{ URL::to('auth/google') }}">
                            <i class="fa fa-google-plus-square" aria-hidden="true"></i> Đăng nhập bằng Google
                        </a>
                        <a href="javascript:;" data-toggle="modal" data-target="#registerModal">Bạn chưa có tài khoản?
                            Đăng ký ngay!</a>
                        <a href="javascript:;" data-toggle="modal" data-target="#lostPasswordModal">Bạn quên mật
                            khẩu?</a>
                    </div>
                    <div class="right-form">
                        <div class="form-group">
                            <input class="form-control" id="loginEmail" type="text" name="email"
                                   placeholder="Email hoặc số điện thoại">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="loginPassword" type="password" name="password"
                                   placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-group">
                            <label for="remember">Lưu đăng nhập</label>
                            <input type="checkbox" name="remember" id="remember">
                        </div>
                        <button type="submit" class="btn btn-custom btn-login">Đăng nhập</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" id="register-profile">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đăng ký</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="account-form">
                    <div class="left-form">
                        <a class="btn btn-link btn-facebook" href="{{ URL::to('auth/facebook') }}">
                            <i class="fa fa-facebook-official" aria-hidden="true"></i> Đăng ký bằng Facebook
                        </a>
                        <a class="btn btn-link btn-google" href="{{ URL::to('auth/google') }}">
                            <i class="fa fa-google-plus-square" aria-hidden="true"></i> Đăng ký bằng Google
                        </a>
                    </div>
                    <div class="right-form">
                        <div class="form-group">
                            <input class="form-control" id="name" type="text" name="name"
                                   placeholder="Họ và tên">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="username" type="text" name="email"
                                   placeholder="Email hoặc số điện thoại">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="password" type="password" name="password"
                                   placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="confirm_password" type="password"
                                   name="password_confirm" placeholder="Xác nhận mật khẩu mới">
                        </div>
                        <button type="button" class="btn btn-custom btn-register">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lostPasswordModal" tabindex="-1" role="dialog" aria-labelledby="lostPasswordModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="idForgotPassword">Quên mật khẩu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="right-form">
                    <div class="form-group">
                        <input class="form-control" id="lostPasswordUsername" type="email" name="email"
                               placeholder="Nhập email để nhận mã xác thực">
                    </div>
                    <button type="button" class="btn btn-custom btn-lost-password-send-email">Gửi xác thực </button>
                    <button type="button" class="close-form-reset-password">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>