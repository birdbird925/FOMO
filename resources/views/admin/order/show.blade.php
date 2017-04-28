@extends('layouts.admin')

@section('page-direction')
    {{-- <li>
        <i class="pe-7s-box2"></i> CMS
    </li> --}}
    Order
@endsection

@section('order-sidebar')
    active
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">Item Summary</h4>
            </div>
            <div class="content">
                <div class="order-row">
                    <div class="order-header"></div>
                    <div class="order-item-summary">
                        @foreach($order->items as $item)
                            <div class="order-item">
                                <div class="product-image">
                                    <img src="{{$item->product->image}}">
                                </div>
                                <div class="product-info">
                                    <div class="name">
                                        {{$item->product->name}}
                                    </div>
                                    <div class="description">
                                        {{$item->product->description}}
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="quantity">
                                        {{$item->quantity}} pcs
                                    </div>
                                    <div class="price">
                                        $ {{$item->price * $item->quantity}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                @if($order->fulfillStatus())
                    
                @endif

                @if(!$order->fulfillStatus() && $order->order_status)
                    Mark it as Fulfilled
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="header">
                <h4 class="title">Order info</h4>
            </div>
            <div class="content">
                <ul>
                    <li>
                        <span>Code: </span>
                        {{$order->orderCode()}}
                        <i class="fa fa-{{$order->order_status ? 'check' : 'times' }}-circle"></i>
                    </li>
                    <li>
                        <span>Date: </span>
                        {{$order->created_at->toDateTimeString()}}
                    </li>
                    <li>
                        <span>Payment:</span>
                        {{$order->payment_status == 1 ? 'Paid' : 'Unpaid' }}
                    </li>
                    <li>
                        <span>Fulfilled:</span>
                        {{$order->fulfillStatus()  ? 'Fulfilled' : 'Unfulfilled'}}
                    </li>
                    <li>
                        <span>Shipping:</span>
                        $ {{$order->shipping_cost}}
                    </li>
                    <li>
                        <span>Total</span>
                        $ {{$order->subTotal() + $order->shipping_cost}}
                    </li>
                </ul>
                <hr>
                <ul>
                    <li>
                        <span>Recipient:</span>
                        @if($order->user_id)
                            <a href="/admin/customer/{{$order->user_id}}">
                                {{$order->name}}
                            </a>
                        @else
                            {{$order->name}}
                        @endif
                    </li>
                    <li>
                        <span>Email:</span>
                        {{$order->email}}
                    </li>
                    @if($order->phone)
                        <li>
                            <span>Phone:</span>
                            {{$order->phone}}
                        </li>
                    @endif
                    <hr>
                    <li>
                        <span>Address:</span>
                        <br>
                        {{$order->address_line_1}}
                        <br>
                        {!!$order->address_line_2 ? $order->address_line_2.'<br>' : '' !!}
                        {{$order->postcode}}, {{$order->city}}
                        <br>
                        {{$order->state}}, {{$order->country}}
                    </li>
                </ul>
                @if($order->order_status)
                    <hr>
                    <form action="/admin/order/{{$order->id}}/cancel" method="post">
                        {{ csrf_field() }}
                        <input type="submit" value="Cancel order" class="cancel-order btn btn-danger">
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
