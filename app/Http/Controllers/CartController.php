<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function addToCart(Request $request)
    {
        Cart::add($request->course, $request->course_name, 1, $request->price);
        return redirect()->back();
    }

    function cartContent()
    {
        dump(Cart::content());
    }
}
