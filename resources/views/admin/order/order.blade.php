@extends('admin.dashboard.dashboard-master')
@section('title', 'Duyệt đơn hàng')
@section('content')
    <h1 class="template-title">Duyệt đơn hàng</h1>
    @if (session()->has('update'))
        <div class="alert alert-success" role="alert">
            <div class="alert-text">{{session('update')}}</div>
        </div>
    @endif
    <form class="kt-form order-form" method="post">
        <div class="row">
            <div class="col-md-9">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <table class="table table-striped table-hover tnct-table" id="courses">
                            <thead>
                            <tr>
                                <th>Khoá học</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($content->items as $item)
                                <tr>
                                    <td class="kt-font-bold">
                                        <a target="_blank"
                                           href="{{route('GET_EDIT_COURSE_ROUTE', $item->id)}}">{{$item->name}}</a>
                                    </td>
                                    <td>{{number_format($item->price, 0, '.', '.')}} đ</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{number_format($item->qty * $item->price, 0, '.', '.')}} đ</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="order-totals-items">
                            <div class="order-totals-items-wrapper">
                                <div class="subtotal-wrapper">
                                    <div class="mark">Phương thức thanh toán</div>
                                    <div class="amount">
                                        @php
                                            $dataPayment =(object)json_decode($content->payment);
                                        @endphp
                                        {{ $dataPayment->phuong_thuc->ten_ngan_hang }}
                                        {{ $dataPayment->phuong_thuc->so_tai_khoan }}
                                    </div>
                                </div>
                                <div class="subtotal-wrapper">
                                    <div class="mark">Tạm tính</div>
                                    <div class="amount">{{$content->subtotal}} ₫</div>
                                </div>
                                <div class="total-wrapper">
                                    <div class="mark">Tổng tiền</div>
                                    <div class="amount">{{$content->total}} ₫</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Duyệt đơn hàng
                                #{{$order->id}}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label for="post-status">Trạng thái</label>
                            <select class="form-control" id="order-status" name="order_status">
                                <option value="processing" @if($order->order_status === 'processing') {{'selected'}} @endif>
                                    Chờ thanh toán
                                </option>
                                <option value="pending" @if($order->order_status === 'pending') {{'selected'}} @endif>
                                    Đang xử lý
                                </option>
                                <option value="on-hold" @if($order->order_status === 'on-hold') {{'selected'}} @endif>
                                    Tạm giữ
                                </option>
                                <option value="completed" @if($order->order_status === 'completed') {{'selected'}} @endif>
                                    Đã hoàn thành
                                </option>
                                <option value="cancelled" @if($order->order_status === 'cancelled') {{'selected'}} @endif>
                                    Đã hủy
                                </option>
                                <option value="refunded" @if($order->order_status === 'refunded') {{'selected'}} @endif>
                                    Đã hoàn lại tiền
                                </option>
                                <option value="failed" @if($order->order_status === 'failed') {{'selected'}} @endif>
                                    Thất bại
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="customer" value="{{$order->user_id}}">
        {{ csrf_field() }}
    </form>
@endsection
