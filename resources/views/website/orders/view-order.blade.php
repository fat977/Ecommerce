@extends('website.layouts.master')
@section('title','Order Details')
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
                            <li aria-current="page" class="breadcrumb-item"><a href="#">My orders</a></li>
                            <li aria-current="page" class="breadcrumb-item active">Order # 1735</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <!--
            *** CUSTOMER MENU ***
            _________________________________________________________
            -->
                    <div class="card sidebar-menu">
                        <div class="card-header">
                            <h3 class="h4 card-title">Customer section</h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <a href="{{ route('order.history') }}" class="nav-link active"><i class="fa fa-list"></i> My orders</a>
                                <a href="{{ route('wishlists.index') }}" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a>
                                <a href="customer-account.html" class="nav-link"><i class="fa fa-user"></i> My account</a>
                                <a href="index.html" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></ul>
                        </div>
                    </div>
                    <!-- /.col-lg-3-->
                    <!-- *** CUSTOMER MENU END ***-->
                </div>
                <div id="customer-order" class="col-lg-9">
                    <div class="box">
                        <h1>Order #1735</h1>
                        <p class="lead">Order #1735 was placed on <strong>{{ date('d/m/Y',strtotime($order->created_at)) }}</strong> and is currently <strong>Being prepared</strong>.</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
                        <hr>
                        <div class="table-responsive mb-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Unit price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                    <tr>
                                        <td><img src="{{ asset('storage/products/'.$product->image) }}" style="height: 100px; width:100px" alt="{{ $product->name_en }}"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->pivot->price }}</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Order subtotal</th>
                                        <th>${{ $order->total_price}}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Shipping and handling</th>
                                        <th>$10.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Tax</th>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Total</th>
                                        <th>${{ ($order->total_price) + 10 }}.00</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.table-responsive-->
                        <div class="row addresses">
                            
                            <div class="col-lg-12">
                                <h2>Shipping address</h2>
                                <p>{{ $order->address->user->name }}<br>City: {{ $order->address->region->city->name_en }}<br>Region: {{ $order->address->region->name_en }}<br>Street: {{ $order->address->street }}<br>Building: {{ $order->address->building }}<br>Floor: {{ $order->address->floor }}<br></p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
