@extends('themes.parent-theme.initialize')
@section('header')
    @include('themes.child-theme.header')
@endsection
@section('content')
    {{--    @dump($cart_content)--}}
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
                                                {{number_format($item->course_data->price->meta_value, 0, '.', '.')}} ₫
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
