<?php
$course_slider_menu = get_data_menu('course_slider_menu');
?>
<section class="pvtinh-khkt-slider">
    <div class="container">
        <div class="slider-khkt-content">
            <div class="slider-khkt-item slider-left">
                <h6 class="title-category">Khoá học</h6>
                <nav class="category-home">
                    <ul>
                        @foreach($course_slider_menu as $item)
                            <li>
                                <a href="{{ $item->link }}">{{ $item->label }}</a>
                                @if(!empty($menu->childrenMenus)  && sizeof($menu->childrenMenus) > 0)
                                    <ul>
                                        @foreach ($menu->childrenMenus->sortBy('sort') as $menu_sub)
                                            @include('themes.child-theme.menu-children', ['menu' => $menu_sub])
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="slider-khkt-item slider-center">
                {{ render_slider(17, 'slider-khkt-item-slick', '') }}
            </div>

            <div class="slider-khkt-item slider-right">
                <div class="form-khkt-home">
                    <div class="list-socials-contact">
                        <ul>
                            <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                            <li><a href="#"> <i class="fa fa-google"></i> </a></li>
                            <li><a href="#"> <i class="fa fa-linkedin"></i> </a></li>
                        </ul>
                        <p>Hoặc sử dụng form dưới đây để liên hệ</p>
                    </div>
                    <form action="{{route('ADD_FORM_DATA', 1)}}" class="contact-form-home" method="POST">
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
                            <input type="hidden" name="content_form">
                            <select name="course" class="form-control">
                                <option value="">Khoá học mong muốn:</option>
                                @foreach($courseFormContact as $course)
                                    <option value="{{ $course->post_title }}">{{ $course->post_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-form btn-custom-form">Hoàn tất</button>
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