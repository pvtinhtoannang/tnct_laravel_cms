@section('title', 'Đăng nhập')
<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="vi">

<!-- begin::Head -->
<link href="{{ asset('/assets/app/custom/login/login-v6.default.css')  }}" rel="stylesheet" type="text/css"/>

@include ('admin.layouts.head-tags')
<!-- end::Head -->

<!-- begin::Body -->
<body
    class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
        <div
            class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
            <div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
                <div class="kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__body">
                            <div class="kt-login__logo">
                                <a href="#">
                                    <img src="{{ asset('assets/media/company-logos/logo-2.png') }}">
                                </a>
                            </div>
                            <div class="kt-login__signin">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Đăng nhập</h3>
                                </div>
                                <div class="kt-login__form">
                                    <form class="kt-form" action="login" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Email" name="email"
                                                   autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-last" type="password"
                                                   placeholder="Password" name="password">
                                        </div>
                                        <div class="kt-login__extra">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember"> Ghi nhớ mật khẩu
                                                <span></span>
                                            </label>
                                            <a href="javascript:;" id="kt_login_forgot">Bạn quên mật khẩu ?</a>
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_signin_submit"
                                                    class="btn btn-brand btn-pill btn-elevate">Đăng nhập
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="kt-login__forgot">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Bạn quên mật khẩu?</h3>
                                    <div class="kt-login__desc">Nhập email của bạn để khôi phục mật khẩu:</div>
                                </div>
                                <div class="kt-login__form">
                                    <form class="kt-form" action="forgot">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Email" name="email"
                                                   id="kt_email" autocomplete="off">
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_forgot_submit"
                                                    class="btn btn-brand btn-pill btn-elevate">Gửi yêu cầu
                                            </button>
                                            <button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">
                                                Huỷ bỏ
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content"
                 style="background-image: url({{ asset('assets/media/bg/bg-4.jpg') }});">
                <div class="kt-login__section">
                    <div class="kt-login__block">
                        <h3 class="kt-login__title">Toàn Năng Cần Thơ</h3>
                        <div class="kt-login__desc">
                            Tận tâm - Tận lực - Thiết thực - Hiệu quả
                            <br>"Hỗ trợ hết mình - tận tình hướng dẫn"
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->


@include('admin.layouts.footer-scripts')


<script src="{{ asset('assets/app/custom/login/login-general.js')  }}" type="text/javascript"></script>
<!--end::Global App Bundle -->
</body>

<!-- end::Body -->
</html>
