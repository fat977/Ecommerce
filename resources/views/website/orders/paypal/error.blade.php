@extends('website.layouts.master')
@section('title','Payment - error')
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
                        <div class="content">
                            <h3>Your payment has been failed</h3>
                            <p>Please try again after some time . contact us if there any problem</p>
                        </div> 
                    </div>
                    <!-- /.box-->
                </div>
                <!-- /.col-lg-9-->

            </div>
        </div>
    </div>
</div>
@endsection
