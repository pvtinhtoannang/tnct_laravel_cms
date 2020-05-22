<?php

namespace App\Http\Controllers;

use App\Course;
use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $course, $titleWebsite, $order;

    public function __construct()
    {
        $this->course = new Course();
        $this->titleWebsite = new ThemeController();
        $this->order = new Order();
        Cart::setGlobalTax(0);
    }

    function addToCart(Request $request)
    {
        Cart::add($request->course, $request->course_name, 1, $request->price);
        return redirect()->back();
    }

    function ajaxAddToCart(Request $request)
    {
        Cart::add($request->cart_data['course'], $request->cart_data['course_name'], 1, $request->cart_data['price']);
    }

    function cartContent()
    {
        $cart_content = Cart::content();
        $cart_total = Cart::total(0, '.', '.');
        $cart_subtotal = Cart::subtotal(0, '.', '.');
        $title = $this->titleWebsite->getTitleWebsite('gio-hang');

        foreach ($cart_content as $i => $item) {
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
        foreach ($cart_content as $i => $item) {
            $course = $this->course->find($item->id);
            $cart_content[$i]->course_data = $course;
        }
        return view('themes.child-theme.components.mn-khkt-checkout', [
            'titleWebsite' => $title,
            'cart_total' => $cart_total,
            'cart_subtotal' => $cart_subtotal,
            'cart_content' => $cart_content
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
            "payment" => ""
        );
        $payment_content = json_encode($payment);
        $user_id = Auth::user()->id;
        $this->order->create([
            'user_id' => $user_id,
            'order_content' => $payment_content
        ]);
        Cart::destroy();
    }
}
