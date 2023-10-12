@extends('website.layouts.master')
@section('title','Checkout')
@section('content')
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li aria-current="page" class="breadcrumb-item active">Checkout - Order review</li>
                        </ol>
                    </nav>
                    @include('website.includes.message')
                </div>
                <div id="checkout" class="">
                    <div class="box">
                        <form method="POST" action="{{ route('order.placeOrder') }}" class="row">
                            @csrf
                            <h1>Checkout - Order review</h1>
                            <br>
                            @if ($carts->count() > 0)
                            <div class="content col-lg-8">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                                <th>Discount</th>
                                                <th colspan="2">Total</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @php $total_price = 0 @endphp
                                            @foreach ($user->products as $product)
                                            <tr>
                                                <td><a href="#"><img src="{{ asset('storage/products/'.$product->image )}}" style="height: 100px" alt="{{ $product->name_en}}"></a></td>
                                                <td><a href="#">{{ $product->name_en}}</a></td>
                                                <td>{{ $product->pivot->quantity }}</td>
                                                <td>{{ $product->price}}</td>
                                                <td>
                                                    @foreach ($discountedProducts as $sale)
                                                    @if ($sale->name_en == $product->name_en)
                                                        
                                                            %{{$sale->discount}}   
                                                    @endif
                                                    @endforeach
                                                    $0.00
                                                </td>
                                                <td>
                                                    @foreach ($discountedProducts as $sale)
                                                    @if ($sale->name_en == $product->name_en)
                                                        {{ $sale->price_after_discount * $product->pivot->quantity}}
                                                    @endif
                                                    @endforeach
                                                    {{ $product->price * $product->pivot->quantity}}
                                                </td>
                                            </tr>
                                            @foreach ($discountedProducts as $sale)
                                            @if ($sale->name_en == $product->name_en)
                                                @php $total_price = $total_price +( $sale->price_after_discount * $product->pivot->quantity) @endphp
                                           
                                            @endif
                                            @endforeach
                                            @php $total_price = $total_price +( $product->price * $product->pivot->quantity) @endphp

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total</th>
                                                <th colspan="2">${{ $total_price}}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive-->
                            </div>
                            <div class="col-lg-4">
                                <div id="order-summary" class="card">
                                    <div class="card-header">
                                        <h3 class="mt-4 mb-4">Order summary</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Order subtotal</td>
                                                        <th>{{ $total_price}}</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping and handling</td>
                                                        <th>$10.00</th>
                                                    </tr>
                                                    <tr>
                                                        @php
                                                            $startTime = date("Y-m-d");
                                                            $cenvertedTime = date('Y-m-d',strtotime('+1 day',strtotime($startTime)));
                                                        @endphp
                                                        <td>Delivered at</td>
                                                        <th>{{ $cenvertedTime }}</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Payment Method</td>
                                                        <th>
                                                            <input type="hidden" value="{{ $total_price }}" name="total_price">
                                                            <select name="payment_method" id="payment_method" class="form-control">
                                                                <option {{old('payment_method') == 'Cash on delivery' ? 'selected':''}} value="Cash on delivery">Cash on delivery</option>
                                                                <option {{old('payment_method') == 'PayPal' ? 'selected':''}} value="PayPal">PayPal</option>
                                                            </select>
                                                        </th>
                                                    </tr>
                                                    <tr class="total">
                                                        @php $total = $total_price + 10 @endphp
                                                        <td>Total</td>
                                                        <th>${{ $total }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.content-->
                            <div class="box-footer d-flex justify-content-between"><a href="checkout3.html" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to payment method</a>
                                <button type="submit" class="btn btn-primary">Place an order<i class="fa fa-chevron-right"></i></button>
                            </div>
                            @else
                                <div class="content col-lg-8 alert alert-danger">There are no items !</div>
                            @endif
                            
                        </form>
                    </div>
                    <!-- /.box-->
                </div>
                <!-- /.col-lg-9-->
               {{--  <div class="col-lg-4">
                    <div id="order-summary" class="card">
                        <div class="card-header">
                            <h3 class="mt-4 mb-4">Order summary</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Order subtotal</td>
                                            <th>{{ $total_price}}</th>
                                        </tr>
                                        <tr>
                                            <td>Shipping and handling</td>
                                            <th>$10.00</th>
                                        </tr>
                                        <tr>
                                            @php
                                                $startTime = date("Y-m-d");
                                                $cenvertedTime = date('Y-m-d',strtotime('+1 day',strtotime($startTime)));
                                            @endphp
                                            <td>Delivered at</td>
                                            <th>{{ $cenvertedTime }}</th>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <th>Cash on delivery</th>
                                        </tr>
                                        <tr class="total">
                                            @php $total = $total_price + 10 @endphp
                                            <td>Total</td>
                                            <th>${{ $total }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- /.col-lg-3-->
            </div>
        </div>
    </div>
</div>
@endsection
