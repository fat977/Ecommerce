@extends('website.layouts.master')
@section('title','Payment - PayPal')
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
                            <li aria-current="page" class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </nav>
                    @include('website.includes.message')
                </div>
                <div id="checkout" class="col-lg-12">
                    <div class="box text-center">
                        <form method="get" action="{{ route('processTransaction') }}">
                            @csrf
                            <div class="content">
                                <h2>Please make your payment for your order</h2>
                                <input type="image" src="https://www.paypalobjects.com/digitalassets/c/website/marketing/apac/C2/logos-buttons/44_Yellow_CheckOut_Pill_Button.png" name="" id="paypal">
                            </div> 
                        </form>
                    </div>
                    <!-- /.box-->
                </div>
                <!-- /.col-lg-9-->

            </div>
        </div>
    </div>
</div>
@endsection
