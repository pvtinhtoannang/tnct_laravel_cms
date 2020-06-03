<!DOCTYPE html>
<html lang="vi">

<!-- begin::Head -->
@include ('admin.layouts.head-tags')
<!-- end::Head -->
<link href="/assets/app/custom/error/error-v6.demo5.css" rel="stylesheet" type="text/css" />
<!-- begin::Body -->
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">


<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v6" style="background-image: url(../assets/media//error/bg6.jpg);">
        <div class="kt-error_container">
            <div class="kt-error_subtitle kt-font-light">
                <h1>Oops...</h1>
            </div>
            <p class="kt-error_description kt-font-light">
                Có gì đó không đúng!.<br>
                Liên kết của bạn có vẻ đã hết hạn, nếu lạc đường xin hãy <a href="javascript:history.go(-1)"> Quay lại</a>
            </p>
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


<!--end::Global App Bundle -->
</body>

<!-- end::Body -->
</html>
