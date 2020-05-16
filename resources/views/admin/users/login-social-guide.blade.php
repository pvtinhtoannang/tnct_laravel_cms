@extends('admin.dashboard.dashboard-master')
@section('title', 'Hướng dẫn đăng nhập - Đăng ký')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="kt-portlet kt-portlet--bordered">
                <div class="kt-portlet__body">

                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--bordered">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Đăng nhập với mạng xã hội
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <ul>
                                <li>Kết hợp branch account-manage từ github về branch của mình</li>
                                <li>Tại file .env
                                    <ul>
                                        <li><strong>Đối với cấu hình Facebook: </strong></li>
                                        <li style="list-style:none"><code> FACEBOOK_CLIENT_ID=APP_ID </code></li>
                                        <li style="list-style:none"><code> FACEBOOK_CLIENT_SECRET=SECRET_ID </code></li>
                                        <li style="list-style:none"><code>
                                                FACEBOOK_CALLBACK_URL=https://domain.com/auth/facebook/callback </code>
                                        </li>

                                        <li><strong>Đối với cấu hình Google: </strong></li>
                                        <li style="list-style:none"><code> GOOGLE_CLIENT_ID=CLIENT_ID </code></li>
                                        <li style="list-style:none"><code> GOOGLE_CLIENT_SECRET=CLIENT_SECRET_ID </code>
                                        </li>
                                        <li style="list-style:none"><code>
                                                GOOGLE_REDIRECT=https://domain.com/auth/google/callback </code></li>
                                    </ul>
                                </li>
                                <li><strong>Cách lấy các mã để điền vào file: </strong>
                                    <ul>
                                        <li>
                                            Truy cập <a target="_blank"
                                                        href="https://console.developers.google.com/apis/credentials">vào
                                                đây</a> để lấy mã của <code>Google</code>
                                        </li>
                                        <li>Truy cập <a target="_blank" href="https://developers.facebook.com/apps/">vào
                                                đây</a>
                                            để tạo và lấy mã <code>Facebook</code></li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Tại trang Google Console Developer</strong>
                                    <ul>
                                        <li><strong>Bước 1: </strong> Bấm vào CREATE CREDENTIALS</li>
                                        <li><strong>Bước 2: </strong> Chọn OAuth client ID</li>
                                        <li><strong>Bước 3: </strong> Chọn Web Application</li>
                                        <li>
                                            <ul>
                                                <li>Name: Tên ứng dụng của bạn</li>
                                                <li>URIs: <code>https://domain.com</code></li>
                                                <li>Authorized redirect URIs: <code>https://domain.com/auth/google/callback</code>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><strong>Bước 4: </strong> Điền đầy đủ các thông số và tìm cách Verification
                                            <ul>
                                                <li>Application name: <strong>Tên ứng dụng + website của bạn</strong>
                                                </li>
                                                <li>Application logo: <strong>Chuẩn bị 1 logo kích thước 512px x 512px
                                                        hoặc 1024px x 1024px</strong></li>
                                                <li>Support Email: <strong>Điền email xác nhận</strong></li>
                                                <li>Scopes for Google APIs: <strong>Nếu chỉ cần thông tin cơ bản thì
                                                        không cần add scope</strong></li>
                                                <li>Authorized domains: <strong>Điền domain của bạn cần - không điền
                                                        http hoặc https</strong></li>
                                                <li>Application Homepage link: <strong>Điền đường dẫn trang chủ của
                                                        trang web của bạn</strong></li>
                                            </ul>
                                        </li>
                                        <li><strong>Bước 5: </strong> Kiểm tra email để verification</li>
                                    </ul>
                                </li>

                                <li><strong>Tại trang Facebook Developer</strong>
                                    <ul>
                                        <li><strong>Bước 1: </strong> tạo ứng dụng mới</li>
                                        <li><strong>Bước 2: </strong> tạo ứng dụng đăng nhập</li>
                                        <li><strong>Bước 3: </strong> tại tab <code>Sản phẩm</code></li>
                                        <li><strong>Bước 4: </strong> Tại menu Sản phẩm > Cài đặt phần <span
                                                    class="kt-font-danger">URI chuyển hướng OAuth hợp lệ</span> <code>https://domain.com/auth/facebook/callback</code>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <!--end::Portlet-->
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="kt-portlet kt-portlet--bordered">
                <div class="kt-portlet__body">

                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--bordered">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Cấu hình với Laravel
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <ul>
                                <li>Chạy lệnh composer: <code>composer require laravel/socialite</code> để cài đặt nhập
                                    mạng xã hội
                                </li>
                                <li>Tiếp theo cấu hình Laravel Socialite trong
                                    <ul>
                                        <li style="list-style:none"><strong>config/app.php: </strong></li>
                                        <li style="list-style:none">
                                            <code>
                                                'providers' => [ <br>
                                                ... <br>
                                                Laravel\Socialite\SocialiteServiceProvider::class, <br>
                                                ], <br>
                                            </code>
                                        </li>
                                        <li style="list-style:none">
                                            <code>
                                                'aliases' => [ <br>
                                                ... <br>
                                                'Socialite' => Laravel\Socialite\Facades\Socialite::class, <br>
                                                ], <br>
                                            </code>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--bordered">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Xác thực đăng nhập với số điện thoại
                                </h3>
                            </div>
                        </div>

                        <div class="kt-portlet__body">
                            <ul>
                                <li>Xác thực đăng nhập với số điện thoại <span class="kt-font-info">https://www.twilio.com</span>
                                </li>
                                <li><strong>Chạy lệnh: <code> composer require twilio/sdk authy/php </code></strong>
                                </li>
                                <li><strong>Cấu hình trong file <code> .env </code> </strong>
                                    <ul>
                                        <li style="list-style: none">AUTHY_API_KEY=XXXXXXXXXXXXXXXXXXXX</li>
                                        <li style="list-style: none">TWILIO_ACCOUNT_SID=ACXXXXXXXXXXXXXXXXXXX</li>
                                        <li style="list-style: none">TWILIO_AUTH_TOKEN=XXXXXXXXXXXXXXXXXXXXX</li>
                                        <li style="list-style: none">TWILIO_PHONE=APXXXXXXXXXXXXXXXXXXX</li>
                                    </ul>
                                </li>

                                <li><strong>Trong file <code> app/config </code> </strong>
                                </li>

                                <li>
                                    <code>
                                        'twilio' => [ <br>
                                        'AUTHY_API_KEY' => env('AUTHY_API_KEY'), <br>
                                        'TWILIO_ACCOUNT_SID' => env('TWILIO_ACCOUNT_SID'), <br>
                                        'TWILIO_AUTH_TOKEN' => env('TWILIO_AUTH_TOKEN'), <br>
                                        'TWILIO_PHONE' => env('TWILIO_PHONE'), <br>
                                        ], <br>
                                    </code>
                                </li>
                                <li>RrWysRJqBydEMvk51zGIKPsIWrhtrvwUuOpW7ceD</li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
@endsection
