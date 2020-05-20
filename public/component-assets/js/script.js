function lesson_activity() {
    let activity = [];
    $(".section-list .lesson-item").each(function (i, el) {
        let checkbox = $(el).find(".lesson-completed");
        let lesson = checkbox.attr('data-id');
        if (checkbox.is(":checked")) {
            // console.log(lesson, 1);
            activity.push({
                "id": lesson,
                "type": "lesson",
                "status": 1,
            });
        } else {
            activity.push({
                "id": lesson,
                "type": "lesson",
                "status": 0
            });
        }
    });
    return console.log(activity);
}

jQuery(function ($) {
    try {
        //slick dùng để tạo slide
        $('.list-timkhoahoc').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                    }
                }
            ]
        });

        $('.slider-khkt-item-slick').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                    }
                }
            ]
        });


        $('.list-partner').slick({
            slidesToScroll: 1,
            slidesToShow: 6,
            arrows: true,
            autoplaySpeed: 3000,
            arrows: true,

            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        arrows: false
                    }
                }
            ]
        });


        $('.btn-login').click(function () {
            var email = $('#loginEmail').val();
            var password = $('#loginPassword').val();
            var __token = $('meta[name="csrf-token"]').attr('content');
            var remember = $('#remember').val();

            var url = '/login';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: __token,
                    email: email,
                    password: password,
                    remember: remember,
                },
                success: function (res) {
                    if (res === 'Tài khoản hoặc mật khẩu không đúng!') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: 'Tài khoản hoặc mật khẩu chưa đúng!'
                        });
                    } else {
                        Swal.fire(
                            'Đăng nhập thành công',
                            'Chào mừng quay trở lại! Đang chuyển hướng ....',
                            'success'
                        )
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);

                    }
                }, error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: 'Tài khoản hoặc mật khẩu chưa đúng!...',
                    });
                },
            });
        });

        $('.btn-register').click(function () {
            var name = $('#register-profile #name').val();
            var username = $('#register-profile #username').val();
            var password = $('#register-profile #password').val();
            var confirm_password = $('#register-profile #confirm_password').val();
            var __token = $('meta[name="csrf-token"]').attr('content');
            var url = '/dang-ky';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: __token,
                    name: name,
                    email: username,
                    password: password,
                    password_confirmation: confirm_password
                },
                success: function (res) {
                    Swal.fire(
                        'Đã đăng ký thành công!',
                        'Bạn sẽ được chuyển đến trang tài khoản!',
                        'success'
                    )
                    window.location.reload();
                }, error: function (xhr, status, error) {
                    console.log(xhr.responseJSON.message);
                    var message = xhr.responseJSON.message;
                    var errors = '';
                    if (message.name != null) {
                        var name = message.name;
                        jQuery.each(name, function (i, val) {
                            errors += val + ' <br> '
                        });
                    }

                    if (message.email != null) {
                        var email = message.email;
                        jQuery.each(email, function (i, val) {
                            errors += val + ' <br> '
                        });
                    }

                    if (message.password != null) {
                        var password = message.password;
                        jQuery.each(password, function (i, val) {
                            errors += val + ' <br> '
                        });
                    }

                    if (message.password_confirm != null) {
                        var password_confirm = message.password_confirm;
                        jQuery.each(password_confirm, function (i, val) {
                            errors += val + ' <br>'
                        });
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Ôi có lỗi xảy ra rồi...',
                        html: errors,
                    })
                },
            });
        });

        $('.btn-lost-password-send-email').click(function () {
            var email = $('#lostPasswordUsername').val();
            if (email === null || email === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: 'Vui lòng điền email!...',
                });
            } else {
                var __token = $('meta[name="csrf-token"]').attr('content');
                var url = '/reset-password';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: __token,
                        email: email,
                    },
                    beforeSend: function () {
                        $('.btn-lost-password-send-email').append('<i class="fa fa-spin fa-spinner"></i>');
                        $('.btn-lost-password-send-email').attr('disabled', 'disabled');
                    },
                    success: function (res) {
                        if (res * 1 === 1) {
                            swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                    cancelButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                            });
                            $('#lostPasswordModal').modal().hide();
                            $('#lostPasswordModal .btn-lost-password-send-email').removeAttr('disabled');
                            swalWithBootstrapButtons.fire({
                                title: 'Đã gửi?',
                                text: "Email khôi phục đã được gửi đi, nếu không nhận được vui lòng kiểm tra thư mục spam!",
                                icon: 'success',
                                confirmButtonText: 'Vâng! Tôi sẽ kiểm tra email',
                                reverseButtons: true
                            })
                        }
                    }, error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: 'Đã xảy ra lỗi, vui lòng kiểm tra kỹ thuật!...',
                        });
                    },
                });
            }
        });

        $('.close-form-reset-password').click(function () {
            $('.btn-lost-password-send-email i').removeClass('fa fa-spin fa-spinner');
            $('.btn-lost-password-send-email').removeAttr('disabled', 'disabled');
        });

        $('.btn-new-password').click(function () {
            var new_password = $('#new_password').val();
            var new_password_confirm = $('#new_password_confirm').val();
            var token = $('input[name="token"]').val();
            if (new_password !== new_password_confirm) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: 'Mật khẩu xác nhận không đúng!...',
                });
            } else {
                var __token = $('meta[name="csrf-token"]').attr('content');
                var url = '/new-reset-password';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: __token,
                        token: token,
                        password: new_password,
                        password_confirm: new_password_confirm,
                    },
                    beforeSend: function () {
                        $('.btn-new-password').append('<i class="fa fa-spin fa-spinner"></i>');
                        $('.btn-new-password').attr('disabled', 'disabled');
                    },
                    success: function (res) {
                        if (res * 1 === 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công!!...',
                                html: 'Mật khẩu đã được thay đổi!...',
                            });
                            $('.btn-new-password i').removeClass('fa fa-spin fa-spinner');
                            $('#loginModal').modal().show();

                        }
                    }, error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: 'Đã xảy ra lỗi, có vẻ bạn đã đổi mật khẩu hoặc liên kết hết hạn!...',
                        });
                    },
                });
            }
        });

        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });


        $('.lesson-completed').on("change", function () {
            lesson_activity();
        });
    } catch (e) {
        // console.log(e);
    }
});