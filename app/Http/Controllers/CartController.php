<?php

namespace App\Http\Controllers;

use App\Course;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $course;

    public function __construct()
    {
        $this->course = new Course();
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
        $titleWebsite = new ThemeController();
        $title = $titleWebsite->getTitleWebsite('gio-hang');

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
}
