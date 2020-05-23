<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order, $user;

    public function __construct()
    {
        $this->order = new Order();
        $this->user = new User();
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
        if ($request->order_status === 'completed') {
            $this->user->registerPostForUser($request->customer, $id);
        } else {
            $this->user->detachPostForUser($request->customer, $id);
        }
        $this->order->updateStatus($id, $request->order_status);
        return redirect()->route('GET_ORDER_ROUTE', [$id])->with('update', 'Đơn hàng đã được cập nhật');
    }
}
