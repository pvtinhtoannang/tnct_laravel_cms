@extends('admin.dashboard.dashboard-master')
@section('title', 'Đơn hàng')
@section('content')
    <h1 class="template-title">Đơn hàng</h1>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Đơn hàng
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped table-hover tnct-table">
                <thead>
                <tr>
                    <th>Đơn hàng</th>
                    <th>Ngày</th>
                    <th>Tình trạng</th>
                    <th>Tổng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <?php
                    /** @var TYPE_NAME $order */
                    $order_content = json_decode($order->order_content);
                    ?>
                    <tr>
                        <td class="kt-font-bold">
                            <a href="{{route('GET_ORDER_ROUTE', $order->id)}}">#{{$order->id}}</a>
                        </td>
                        <td>{{date_format(date_create($order->created_at),"d/m/Y")}}</td>
                        <td>
                            @if($order->order_status == 'pending')
                                Chờ thanh toán
                            @elseif($order->order_status == 'failed')
                                Thất bại
                            @elseif($order->order_status == 'processing')
                                Đang xử lý
                            @elseif($order->order_status == 'completed')
                                Đã hoàn thành
                            @elseif($order->order_status == 'on-hold')
                                Tạm giữ
                            @elseif($order->order_status == 'cancelled')
                                Đã huỷ
                            @elseif($order->order_status == 'refunded')
                                Đã hoàn tiền
                            @endif
                        </td>
                        <td>
                            {{$order_content->total}} đ
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
@endsection
