@php
$option = new \App\Option();
@endphp
<section class="pvtinh-khkt-header blade">
    <div class="container">
        <div class="header-content">
            <div class="logo-header">
                <a href="/" title="<?= $option->getField('blogname') ?>">
                    <img src="/component-assets/images/logo.png" alt="<?= $option->getField('blogname') ?>">
                </a>
            </div>
            <div class="menu-header-content">
                <nav class="menu-header">
                    <ul>
                        <li>
                            <a href="{{ $option->getField('header_menu_khoahoc_url') }}" title="{{ $option->getField('header_menu_khoahoc_text') }}">
                                <img src="/component-assets/images/img-1.png" alt="" class="img">
                                <img src="/component-assets/images/img-1-hover.png" alt="" class="img-hover">
                                <span>{{ $option->getField('header_menu_khoahoc_text') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $option->getField('header_menu_thuvien_url') }}" title="{{ $option->getField('header_menu_thuvien_text') }}">
                                <img src="/component-assets/images/img-2.png" alt="" class="img">
                                <img src="/component-assets/images/img-2-hover.png" alt="" class="img-hover">
                                <span>{{ $option->getField('header_menu_thuvien_text') }}</span>
                            </a>
                            <ul>
                                <li><a href="{{ $option->getField('header_menu_phanmem_url') }}" title="{{ $option->getField('header_menu_phanmem_text') }}">{{ $option->getField('header_menu_phanmem_text') }}</a></li>
                                <li><a href="{{ $option->getField('header_menu_tailieu_url') }}" title="{{ $option->getField('header_menu_tailieu_text') }}">{{ $option->getField('header_menu_tailieu_text') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ $option->getField('header_menu_lienhe_url') }}" title="{{ $option->getField('header_menu_huongdan_text') }}">
                                <img src="/component-assets/images/img-3.png" alt="{{ $option->getField('header_menu_lienhe_text') }}" class="img">
                                <img src="/component-assets/images/img-3-hover.png" alt="" class="img-hover">
                                <span>{{ $option->getField('header_menu_lienhe_text') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $option->getField('header_menu_huongdan_url') }}" title="{{ $option->getField('header_menu_huongdan_text') }}">
                                <img src="/component-assets/images/img-4.png" alt="{{ $option->getField('header_menu_huongdan_text') }}" class="img">
                                <img src="/component-assets/images/img-4-hover.png" alt="" class="img-hover">
                                <span>{{ $option->getField('header_menu_huongdan_text') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $option->getField('header_menu_phone_url') }}" title="{{ $option->getField('header_menu_phone_text') }}">
                                <img src="/component-assets/images/img-5.png" alt="{{ $option->getField('header_menu_phone_text') }}" class="img">
                                <img src="/component-assets/images/img-5-hover.png" alt="" class="img-hover">
                                <span>{{ $option->getField('header_menu_phone_text') }}</span>
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
                                <a class="dropdown-item" href="{{ route('MY_COURSE') }}">Khoá học</a>
                                <a class="dropdown-item" href="{{ route('CART') }}">Giỏ hàng</a>
                                <a class="dropdown-item"  data-toggle="modal" data-target="#updatePasswordModal" href="#">Đổi mật khẩu</a>
                                <a class="dropdown-item" href="{{ route('getLogout') }}">Đăng xuất</a>
                            </div>
                        </div>
                    @else
                        <button class="" data-toggle="modal" data-target="#loginModal">Đăng nhập</button>
                        <button class="" data-toggle="modal" data-target="#registerModal">Đăng ký</button>
                    @endif

                    <button class="menu-mobile"><i class="fa fa-bars"></i></button>
                </div>
                @include ('themes.child-theme.login')
            </div>
        </div>
    </div>
</section>
