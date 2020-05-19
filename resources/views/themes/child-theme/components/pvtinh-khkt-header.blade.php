<section class="pvtinh-khkt-header blade">
    <div class="container">
        <div class="header-content">
            <div class="logo-header">
                <a href="/">
                    <img src="/component-assets/images/logo.png" alt="">
                </a>
            </div>
            <div class="menu-header-content">
                <nav class="menu-header">
                    <ul>
                        <li>
                            <a href="#">
                                <img src="/component-assets/images/img-1.png" alt="" class="img">
                                <img src="/component-assets/images/img-1-hover.png" alt="" class="img-hover">
                                <span>Các khoá học</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/component-assets/images/img-2.png" alt="" class="img">
                                <img src="/component-assets/images/img-2-hover.png" alt="" class="img-hover">
                                <span>Thư viện</span>
                            </a>
                            <ul>
                                <li><a href="">Phần mềm</a></li>
                                <li><a href="">Tài liệu</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/component-assets/images/img-3.png" alt="" class="img">
                                <img src="/component-assets/images/img-3-hover.png" alt="" class="img-hover">
                                <span>Hướng dẫn</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/component-assets/images/img-4.png" alt="" class="img">
                                <img src="/component-assets/images/img-4-hover.png" alt="" class="img-hover">
                                <span>Liên hệ</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/component-assets/images/img-5.png" alt="" class="img">
                                <img src="/component-assets/images/img-5-hover.png" alt="" class="img-hover">
                                <span>090.133.4444</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="login-button">
                @if(!empty($users_data) || $users_data !== null)
                    <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                {{ $users_data->name  }}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('GET_MY_ACCOUNT') }}">Tài khoản</a>
                                <a class="dropdown-item" href="#">Khoá học</a>
                                <a class="dropdown-item"  data-toggle="modal" data-target="#updatePasswordModal" href="#">Đổi mật khẩu</a>
                                <a class="dropdown-item" href="{{ route('getLogout') }}">Đăng xuất</a>
                            </div>
                        </div>
                    @else
                        <button class="" data-toggle="modal" data-target="#loginModal">Đăng nhập</button>
                        <button class="" data-toggle="modal" data-target="#registerModal">Đăng ký</button>
                    @endif

                    <button class="menu-mobile"><i class="fa fa-bars"></i> Menu</button>
                </div>
                @include ('themes.child-theme.login')
            </div>
        </div>
    </div>
</section>
