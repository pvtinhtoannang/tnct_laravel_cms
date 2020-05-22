@extends('themes.parent-theme.initialize')
@section('header')
    @include('themes.child-theme.header')
@endsection
@section('content')
    {{--    @dump($cart_content)--}}
    @if (session()->has('error'))
        <script>
            jQuery(function ($) {
                Swal.fire({
                    title: 'Bạn chưa đăng nhập?',
                    text: "Xin vui lòng đăng nhập hoặc đăng ký để mua khoá học!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đăng nhập',
                    cancelButtonText: 'Huỷ',
                }).then((result) => {
                    if (result.value) {
                        $('#loginModal').modal('show');
                    }
                })
            })
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            jQuery(function ($) {
                Swal.fire({
                    title: 'Đặt mua thành công',
                    text: "Chúng tôi sẽ cấp quyền truy cập khoá học ngay sau khi nhận được thanh toán, xin cảm ơn quý khách!",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok',
                }).then((result) => {
                    if (result.value) {

                    }
                })
            })
        </script>
    @endif
    <section class="mn-khkt-checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-wrapper">
                        <div class="card-title">Thanh toán khóa học</div>
                        <form id="payment-form" action="{{route('PAYMENT')}}" method="post">
                            @foreach($cart_content as $item)
                                <input type="hidden"
                                       name="course[]"
                                       value="{{$item->rowId}}">
                            @endforeach
                            <div class="btn-wrapper">
                                <button type="submit">Đặt mua</button>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-wrapper">
                        <div class="card-title">Hoá đơn</div>
                        <div class="cart-items-wrapper">
                            <ul class="items">
                                @foreach($cart_content as $item)
                                    <li class="course-item">
                                        <div class="course-name">
                                            <div class="name">{{$item->course_data->post_title}}</div>
                                        </div>
                                        <div class="course-price">
                                            <div class="price">
                                                @if($item->course_data->sale_price && $item->course_data->price)
                                                    @if((integer)$item->course_data->sale_price->meta_value !== 0 && (integer)$item->course_data->price->meta_value !== 0)
                                                        {{number_format($item->course_data->sale_price->meta_value, 0, '.', '.')}}
                                                        ₫
                                                    @elseif((integer)$item->course_data->price->meta_value !== 0)
                                                        {{number_format($item->course_data->price->meta_value, 0, '.', '.')}}
                                                        ₫
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="subtotal-wrapper">
                            <div class="mark">Tạm tính</div>
                            <div class="amount">{{$cart_subtotal}} ₫</div>
                        </div>
                        <div class="total-wrapper">
                            <div class="mark">Tổng tiền</div>
                            <div class="amount">{{$cart_total}} ₫</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    @include('themes.child-theme.footer')
@endsection
