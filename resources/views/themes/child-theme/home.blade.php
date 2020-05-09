<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#accountModal">
    Launch demo modal
</button>
<!-- Modal -->
<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đăng nhập đăng ký nha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-form-tab" data-toggle="pill" href="#login-form" role="tab"
                           aria-controls="pills-home" aria-selected="true">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-profile-tab" data-toggle="pill" href="#register-profile" role="tab"
                           aria-controls="pills-profile" aria-selected="false">Đăng ký</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="login-form" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="form-group">
                            <label for="username">Email hoặc số điện thoại: </label>
                            <input class="form-control" id="username" type="text" name="username" placeholder="Email hoặc số điện thoại">
                        </div>
                        <div class="form-group">
                            <label for="username">Mật khẩu: </label>
                            <input class="form-control" id="username" type="password" name="username" placeholder="Nhập mật khẩu">
                        </div>
                        <button type="button" class="btn btn-success">Đăng nhập</button>
                    </div>
                    <div class="tab-pane fade" id="register-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            <div class="form-group">
                                <label for="name">Nhập tên của bạn:  </label>
                                <input class="form-control" id="name" type="text" name="name" placeholder="Họ và tên">
                            </div>
                            <div class="form-group">
                                <label for="username">Email hoặc số điện thoại: </label>
                                <input class="form-control" id="username" type="text" name="email" placeholder="Email hoặc số điện thoại">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu: </label>
                                <input class="form-control" id="password" type="password" name="password" placeholder="Nhập mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Nhập lại mật khẩu: </label>
                                <input class="form-control" id="confirm_password" type="password" name="password_confirm" placeholder="Xác nhận mật khẩu mới">
                            </div>
                            <button type="button" class="btn btn-success btn-register">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>