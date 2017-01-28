<?php

namespace App\Http\Controllers;

use App\Book;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CartsController extends Controller
{
    /**
     * [postAddToCart description]
     * @return [type] [description]
     */
    public function postAddToCart()
    {
      $rules= array(
         'amount' => 'required|numeric',
         'book' => 'required|numeric|exists:books,id'
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
        return redirect('index')->with('error', 'The book could not be added to your cart!');      }
      $member_id = Auth::user()->id;
      $book_id = Input::get('book');
      $amount = Input::get('amount');

      $book = Book::find($book_id);
      $total = $amount*$book->price;

      $count = Cart::where('book_id', '=', $book_id)->where('member_id', '=', $member_id)->count();

      if ($count) {
        return redirect('index')->with('error', 'The book already in your cart.');
      }

      Cart::create(
        array(
          'member_id' => $member_id,
          'book_id' => $book_id,
          'amount' => $amount,
          'total' => $total
      ));

      return redirect('carts.cart');
    }

    /**
     * [getIndex description]
     * @return [type] [description]
     */
    public function getIndex()
    {
      $member_id = Auth::user()->id;

      $cart_books = Cart::with('Books')->where('member_id', '=', $member_id)->get();

      $cart_total = Cart::with('Books')->where('member_id', '=', $member_id)->sum('total');

      if (!$cart_books) {
        return redirect('index')->with('error', 'Your cart is empty');
      }

      return view('carts.cart')
          ->with('cart_books', $cart_books)
          ->with('cart_total', $cart_total);
    }

    /**
     * [getDelete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDelete($id)
    {
      $cart = Cart::find($id)->delete();

      return redirect('carts.cart');
    }
}
