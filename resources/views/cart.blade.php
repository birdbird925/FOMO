@extends('layouts.app')

@section('logo-class')
    fixed
@endsection

@section('footer-class')
    {{sizeof(Session::get('cart.item')) > 0 ? 'hide' : ''}}
    mobile-hide
@endsection

@section('content')
    <div class="cart-wrapper">
        <div class="cart-body">
            <div class="title page-title">Your Cart</div>

            @if(sizeof(Session::get('cart.item')) == 0)
                <div class="empty-msg">
                    <p>Oops! Empty cart is not cool.</p>
                    <a href="/customize/">Built your first watch</a>
                </div>
            @else
                <table class="product-table table">
                    @foreach(Session::get('cart.item') as $index=>$item)
                        <tr>
                            <td class="image-col" align="center">
                                <div id="{{$item['code']}}" class="konvas-thumb" data-thumb="{{$item['thumb']}}"></div>
                            </td>
                            <td class="description-col col-md-4">
                                <div class="name">{{$item['name']}}</div>
                                <div class="description">{{$item['description']}}</div>
                            </td>
                            <td class="quantity-col">
                                1 piece
                            </td>
                            <td class="price-col">
                                $ {{$item['price']}}
                            </td>
                            <td class="control-col">
                                <a href="/customize/{{$item['code']}}" class="edit">Edit</a>
                                <form action="/cart/{{$index}}/remove" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="remove"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tabel>

                <table class="shipping-table">
                    <tr>
                        <td class="shipping-label">Shipping</td>
                        <td class="coutry">
                            <select name="shipping-country">
                                <option value="" {{Session::get('cart.shipping.location') == "" ? 'selected' : ''}}>SELECT</option>
                                <option data-price="20" {{Session::get('cart.shipping.location') == "UK/US" ? 'selected' : ''}}>UK/US</option>
                                <option data-price="10" {{Session::get('cart.shipping.location') == "ASIAN" ? 'selected' : ''}}>ASIAN</option>
                                <option data-price="0" {{Session::get('cart.shipping.location') == "EURO" ? 'selected' : ''}}>EURO</option>
                            </select>
                        </td>
                        <td class="price">
                            $ {{Session::get('cart.shipping.cost') > 0 ? Session::get('cart.shipping.cost') : 0}}
                        </td>
                        <td class="control">
                            <a id="shipping-trigger">Edit</a>
                        </td>
                    </tr>
                </table>
            @endif
        </div>
        @if(sizeof(Session::get('cart.item')) != 0)
        <div class="cart-footer">
            <div class="caption">TOTAL</div>
            <div class="total">
                $ <span>{{Session::get('cart.total')}}</span>
            </div>
            <form id="checkout-form" action="/checkout" method="post">
                {{ csrf_field() }}
                <a id="checkout-button" class="checkout">Proceed to checkout</a>
            </form>
        </div>
        @endif
    </div>

@endsection
