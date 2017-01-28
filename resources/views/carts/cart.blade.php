@extends('main_layout')

@section('content')
  <h1>Your Cart</h1>
  <table class="table">
    <tbody>
      <tr>
        <td>
          <b>Title</b>
        </td>
        <td>
          <b>Amount</b>
        </td>
        <td>
          <b>Price</b>
        </td>
        <td>
          <b>Total</b>
        </td>
        <td>
          <b>Delete</b>
        </td>
      </tr>
      @foreach($cart_books as $cart_item)
        <tr>
          <td>
            {{$cart_item->Books->title}}
          </td>
          <td>
            {{$cart_item->amount}}
          </td>
          <td>
            {$cart_item->Books->price}
          </td>
          <td>
            {{$cart_item->total}}
          </td>
          <td>
            <a href="{{URL::route('delete_book_from_cart', array($cart_item->id))}}">Delete</a>
          </td>
        </tr>
      @endforeach
      <tr>
        <td></td>
        <td>
          <b>Total</b>
        </td>
        <td>
          <b>{{$cart_total}}</b>
        </td>
      </tr>
    </tbody>
  </table>
  <h2>Shipping</h2>
  <form action="/order" method="post" accept-charset="UTF-8">
    {!! csrf_field() !!}
    <label>Address</label>
    <textarea name="address" rows="5" class="span4"></textarea>
    <button class="btn btn-block btn-primary btn-large">Place order</button>
  </form>
@stop