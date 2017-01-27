<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CartsController extends Controller
{
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
    }
}
