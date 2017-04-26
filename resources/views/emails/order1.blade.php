@extends('layouts.mail')

@section('content')
<tr>
	<td bgcolor="#ffffff" style="padding: 20px 20px 20px 20px;">
		<p style="font-weight: bold; font-size: 20px; width: 100%;">
			Thank you for your purchase!
			<span style="float: right; font-size: 16px; line-height: 20px; color: #c4c4c4">ORDER {{ $order->orderCode() }}</span>
		</p>
		<p style="color: #999999; line-height: 22px;">
			Hi {{ $order->name }}, we're getting your order ready to be shipped.
			<br>
			We will notify you when it has been sent.
		</p>
		<p style="line-height: 22px;">
		Here your order invoice
		<br>
		<a href="{{ url('/invoice/'.hash('crc32b', $order->orderCode())) }}">{{ url('/invoice/'.hash('crc32b', $order->orderCode())) }}</a>
		</p>
		<p style="line-height: 22px;">
		Visit <a href="{{ url('/') }}">our store</a> to find more fabulous product.
		</p>
	</td>
</tr>
<tr>
	<td bgcolor="#ffffff" style="padding: 0px 20px 0px 20px; border-top: 1px solid #DEDEDE">
		<p style="font-weight: bold; font-size: 18px;">Order summary</p>
	</td>
</tr>
@foreach($order->items as $item)
<tr>
	<td bgcolor="#ffffff" style="border-bottom: 1px solid #DEDEDE;">
		<table>
			<tr>
				<td style="padding: 0px 20px 20px 20px;" valign="top">
					<img src="{{ $item->product->image }}" width="100px" style="margin-right: 50px;">
				</td>
				<td width="50%" valign="top">
					<p style="font-weight: bold; margin: 5px auto 10px auto;">
					{{ $item->product->name }} x {{ $item->quantity }}
					</p>
					<p style="font-size: 14px; font-weight: 100; line-height: 20px;">
					{{-- @if($item->size != null)
					Size: {{ $item->size }}
					@endif --}}
					<br>
					$ {{ $item->price }}
					</p>
				</td>
				<td width="25%" valign="top">
					<p style="font-weight: bold; margin: 5px auto 10px auto">$ {{ number_format($item->price * $item->quantity,2) }}</p>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; border-bottom: 1px solid #DEDEDE;">
		<table style="float: right;">
			<tr>
				<td style="color: #999999;  padding: 0px 0px 10px 0px;">Subtotal</td>
				<td width="180px" style="text-align: right; font-weight: bold; padding: 0px 0px 10px 0px;">
				$ {{ number_format($order->subtotal(), 2) }}
				</td>
			</tr>
			<tr>
				<td style="color: #999999;  padding: 0px 0px 20px 0px; border-bottom: 1px solid #DEDEDE;">Shipping</td>
				<td width="180px" style="text-align: right; font-weight: bold; padding: 0px 0px 20px 0px; border-bottom: 1px solid #DEDEDE;">
				$ {{ $order->shipping_cost }}
				</td>
			</tr>
			<tr>
				<td style="color: #999999;  padding: 20px 0px 20px 0px;">Total</td>
				<td width="180px" style="text-align: right; font-weight: bold; font-size: 24px; padding: 20px 0px 20px 0px;">
				$ {{ (number_format($order->subtotal(), 2)+$order->shipping_cost) }}
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td bgcolor="#ffffff" style="padding: 0px 20px 0px 20px;">
		<p style="font-weight: bold; font-size: 18px;">Customer information</p>
	</td>
</tr>
<tr>
	<td bgcolor="#ffffff" style="padding: 0px 20px 0px 20px;">
		<p style="float: right; line-height: 20px; font-size: 14px; margin: 20px 40px 20px 0px;">
			<span style="font-weight: bold; font-size: 16px; line-height: 22px;">Contact details</span>
			<br>
			{{ $order->name }}
			<br>
			{!! $order->phone != null ? $order->phone.'<br>' : '' !!}
			{{ $order->email }}
		</p>
		<p style="line-height: 20px; font-size: 14px;">
		<span style="font-weight: bold; font-size: 16px; line-height: 22px;">Shipping Address</span>
		<br>
		{{ $order->address_line_1 }}
        <br>
        {!! $order->address_line_2 != null ? $order->address_line_2.'<br>' : '' !!}
        {{ $order->postcode }}, {{ $order->city }}
		<br>
        {{ $order->state }}
		<br>
		{{ $order->country}}
		</p>
	</td>
</tr>
<tr>
	<td bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; border-top: 1px solid #DEDEDE;">
	<p>If you have any questions, reply to this email or contact us at <a href="mailto:contact@deleather.com">contact@deleather.com</a></p>
	</td>
</tr>
@endsection
