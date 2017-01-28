<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{ 
    /**
     * [postOrder description]
     * @return [type] [description]
     */
    public function postOrder()
    {
      $rules = array(
        'address' => 'required'
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
        return redirect('carts.cart')->with('error', 'Address field is required!');
      }

      $member_id = Auth::user()->id;
      $address = Input::get('address');

      $cart_books = Cart::with('Books')->where('member_id', '=', $member_id)->get();

      $cart_total = Cart::with('Books')->where('member_id', '=', $member_id)->sum('total');

      if (!$cart_books) {
        return redirect('index')->with('error', 'Your cart is empty.');
      }

      $order = Order::create(array(
        'member_id' => $member_id,
        'address' => $address,
        'total' => $cart_total
      ));

      foreach ($cart_books as $order_books) {
        $order->orderItems()->attach($order_books->book_id, array(
            'amount' => $order_books->amount,
            'price' => $order_books->Books->price, 
            'total' => $order_books->Books->price * $order_books->amount
        ));
      }

      Cart::where('member_id', '=', $member_id)->delete();

      return redirect('index')->with('message', 'Your order processed successfully.');
    }

    /**
     * [getIndex description]
     * @return [type] [description]
     */
    public function getIndex()
    {
      $member_id = Auth::user()->id;

      if (Auth::user()->admin) {
        $orders = Order::all();
      } else {
        $orders = Order::with('orderItems')->where('member_id', '=', $member_id)->get();
      }

      if (!$orders) {
        return redirect('index')->with('error', 'There is no order.');
      }

      return view('orders.order')->with('orders', $orders);
    }
}
