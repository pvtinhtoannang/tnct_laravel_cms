<?php

namespace App\Http\Controllers;

use App\Course;
use App\Option;
use App\Order;
use App\Mail\OrderEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    private $course, $titleWebsite, $order, $option;

    public function __construct()
    {
        $this->course = new Course();
        $this->titleWebsite = new ThemeController();
        $this->order = new Order();
        $this->option = new Option();
        Cart::setGlobalTax(0);
    }

    function addToCart(Request $request)
    {
        Cart::add($request->course, $request->course_name, 1, $request->price);
        $cart_content = Cart::content();
        foreach ($cart_content as $i => $item) {
            Cart::update($item->rowId, 1);
        }
        return redirect()->route('CART');
    }

    function ajaxAddToCart(Request $request)
    {
        Cart::add($request->cart_data['course'], $request->cart_data['course_name'], 1, $request->cart_data['price']);
        $cart_content = Cart::content();
        foreach ($cart_content as $i => $item) {
            Cart::update($item->rowId, 1);
        }
    }

    function cartContent()
    {
        $cart_content = Cart::content();
        $cart_total = Cart::total(0, '.', '.');
        $cart_subtotal = Cart::subtotal(0, '.', '.');
        $title = $this->titleWebsite->getTitleWebsite('gio-hang');

        foreach ($cart_content as $i => $item) {
            Cart::update($item->rowId, 1);
            $course = $this->course->find($item->id);
            $cart_content[$i]->course_data = $course;
        }

        return view('themes.child-theme.components.mn-khkt-cart', [
            'titleWebsite' => $title,
            'cart_total' => $cart_total,
            'cart_subtotal' => $cart_subtotal,
            'cart_content' => $cart_content
        ]);
    }

    function ajaxDeleteItemFromCart(Request $request)
    {
        if (Cart::remove($request->item)) {
            return true;
        } else {
            return false;
        }
    }

    function checkout()
    {

        $title = $this->titleWebsite->getTitleWebsite('thanh-toan');
        $cart_content = Cart::content();
        $cart_total = Cart::total(0, '.', '.');
        $cart_subtotal = Cart::subtotal(0, '.', '.');
        $optionPaymentMethod =  $this->option->getField('phuong_thuc_thanh_toan');
        foreach ($cart_content as $i => $item) {
            Cart::update($item->rowId, 1);
            $course = $this->course->find($item->id);
            $cart_content[$i]->course_data = $course;
        }
        return view('themes.child-theme.components.mn-khkt-checkout', [
            'titleWebsite' => $title,
            'cart_total' => $cart_total,
            'cart_subtotal' => $cart_subtotal,
            'cart_content' => $cart_content,
            'payment_methods'=>$optionPaymentMethod
        ]);
    }

    function payment(Request $request)
    {
        $items = [];
        $payment = [];
        $cart_total = Cart::total(0, '.', '.');
        $cart_subtotal = Cart::subtotal(0, '.', '.');
        $cart_count = Cart::count();
        foreach ($request->course as $rowId) {
            $item = Cart::get($rowId);
            array_push($items, array(
                    "id" => $item->id,
                    "qty" => $item->qty,
                    "name" => $item->name,
                    "price" => $item->price
                )
            );
        }
        $payment = array(
            "items" => $items,
            "subtotal" => $cart_subtotal,
            "total" => $cart_total,
            "count" => $cart_count,
            "payment" =>  $request->payment_method
        );
        $payment_content = json_encode($payment);
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $order = $this->order->create([
                'user_id' => $user_id,
                'order_content' => $payment_content
            ]);

            $orderID = $order->id;

            Cart::destroy();

            $objEmail = new \stdClass();
            $objEmail->name = Auth::user()->name;
            $objEmail->items = $items;
            $objEmail->cart_id = $orderID;
            $objEmail->cart_subtotal = $cart_subtotal;
            $objEmail->cart_total = $cart_total;
            $objEmail->payment_method = $request->payment_method;
            if(Mail::to(Auth::user()->email)->send(new OrderEmail($objEmail))){}
            return redirect()->route('GET_MY_ACCOUNT')->with('success', 'Đặt mua khoá học thành công.');

        } else {
            return redirect()->back()->with('error', 'Bạn chưa đăng nhập.');
        }
    }
}
