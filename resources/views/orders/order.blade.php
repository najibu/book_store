@extends('layouts.main_layout')

@section('content')
  <h3>Your orders</h3>

  <div class="menu">
    <div class="accordion">
      @foreach($orders as $order)
        <div class="accordion-group">
          <div class="accordion-heading country">
            @if(Auth::user()->admin)
              <a class="accordion-toggle" data-toggle="collapse" href="#order{{$order->id}}">Order #{{$order->id}} - {{$order->User->name}} - {{$order->created_at}}</a>
            @else
              <a class="accordion-toggle" data-toggle="collapse" href="#order{{$order->id}}">Order #{{$order->id}} - {{$order->created_at}}</a>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
@stop