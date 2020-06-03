<?php
$course_slider_menu = get_data_menu('course_slider_menu');
?>

<section class="mn-khkt-single pvtinh-khkt-contact-page">
    <div class="container">
        <div class="entry-content">
            <h1 class="entry-title">{{$post->post_title}}</h1>
            <div class="post-content">
                <div class="form-khkt-home">

                    <form action="{{route('ADD_FORM_DATA', 2)}}" class="contact-form-home" method="POST">
                        @csrf
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                </div>
                            </div>
                            <input type="text" required name="name" class="form-control" id="full_name_contact"
                                   placeholder="Họ tên:">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" required name="phone" class="form-control" id="phone_contact"
                                   placeholder=" Số điện thoại:   ">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                </div>
                            </div>
                            <input type="text" required name="email" class="form-control" id="email_contact"
                                   placeholder="Email:">
                        </div>

                        <div class="form-group">
                            <input type="text" name="company_name" id="companyName" placeholder="Tên công ty:"
                                   class="form-control"
                                   aria-describedby="companyName">
                        </div>
                        <div class="form-group">
                            <input type="text" name="position" id="position" placeholder="Chức danh: "
                                   class="form-control"
                                   aria-describedby="position">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" id="address" placeholder="Địa chỉ: " class="form-control"
                                   aria-describedby="address">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="course">
                            <textarea name="content_form" rows="5" class="form-control" placeholder="Nhập nội dung liên hệ">{{ old('content_form') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-form btn-success btn-custom-form">Hoàn tất</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@if ($message = Session::get('messages'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'success',
                title: 'Thành công...',
                html: '{{$message}}'
            });
        });
    </script>
@endif
@if ($message = Session::get('errors'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '{{$message}}'
            });
        });
    </script>
@endif