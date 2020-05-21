@extends('themes.parent-theme.initialize')
@section('header')
    {{--    @include('themes.child-theme.header')--}}
@endsection
@section('content')
    {{--    @dump($cart_content)--}}
    <section class="mn-khkt-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @foreach($cart_content as $item)
                        <div class="card-wrapper course-item">
                            <div class="card-img">
                                <img src="{{get_thumbnail_src($item->course_data)}}"
                                     alt="{{$item->course_data->post_title}}">
                            </div>
                            <div class="course-content">
                                <a class="course-name"
                                   href="/{{$item->course_data->post_name}}">{{$item->course_data->post_title}}</a>
                            </div>
                            <div class="course-price">
                                @if($item->course_data->sale_price && $item->course_data->price)
                                    @if((integer)$item->course_data->sale_price->meta_value !== 0 && (integer)$item->course_data->price->meta_value !== 0)
                                        <div class="price">{{number_format($item->course_data->sale_price->meta_value, 0, '.', '.')}}
                                            ₫
                                        </div>
                                        <div class="old-price">{{number_format($item->course_data->price->meta_value, 0, '.', '.')}}
                                            ₫
                                        </div>
                                    @elseif((integer)$item->course_data->price->meta_value !== 0)
                                        <div class="price">{{number_format($item->course_data->price->meta_value, 0, '.', '.')}}
                                            ₫
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="delete-area">
                                <span class="delete-item" data-id="{{$item->rowId}}"><i class="fa fa-trash"
                                                                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <div class="card-wrapper checkout-area">
                        <div class="card-title">Thông tin đơn hàng</div>
                        <table class="checkout-table">
                            <tbody>
                            <tr class="sub">
                                <th class="mark" colspan="1" scope="row">Tạm tính</th>
                                <td class="amount" data-th="Subtotal">
                                    <span class="price">{{$cart_subtotal}} ₫</span>
                                </td>
                            </tr>
                            <tr class="totals">
                                <th class="mark" colspan="1" scope="row">
                                    <strong>Tổng tiền</strong>
                                </th>
                                <td class="amount" data-th="Order Total">
                                    <strong><span class="price">{{$cart_total}} ₫</span></strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="checkout"><span>Tiến hành đặt mua</span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    {{--    @include('themes.child-theme.footer')--}}
@endsection
