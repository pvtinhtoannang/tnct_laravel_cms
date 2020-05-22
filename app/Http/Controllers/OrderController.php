<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    function index()
    {
        $orders = $this->order->get();
        return view('admin.order.orders', ['orders' => $orders]);
    }

    function getOrder($id)
    {
        $order = $this->order->find($id);
        $order_content = json_decode($order->order_content);
        return view('admin.order.order', ['order' => $order, 'content' => $order_content]);
    }

    function updateOrder(Request $request, $id)
    {
        $this->order->updateStatus($id, $request->order_status);
        return redirect()->route('GET_ORDER_ROUTE', [$id])->with('update', 'Đơn hàng đã được cập nhật');
    }
}
