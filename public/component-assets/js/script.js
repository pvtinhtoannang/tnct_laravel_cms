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


    } catch (e) {
        // console.log(e);
    }
});