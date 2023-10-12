@extends('website.layouts.master')
@section('title','Wishlist')
@section('content')
<div id="all" class="WishlistItems">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li aria-current="page" class="breadcrumb-item active">Wishlist</li>
                        </ol>
                    </nav>
                </div>
                <div id="basket" class="col-lg-12">
                    <div class="box">
                        @if ($wislists->count() > 0)
                        
                            <h1>Wishlist</h1>
                            <p class="text-muted">You currently have {{ $wislists->count() }} item(s) in your wishlist.</p>
                            @include('website.includes.message')
                            <div class="table-responsive">
                                <table class="table">
                                    @if ($wislists->count() > 0)
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                        </tr>
                                    </thead>
                                    @endif
                                    <tbody>
                                        @forelse ($user->product_wishlists as $product)
                                        <tr  class="product_data">
                                            <td>
                                                <a href="#"><img src="{{ asset('storage/products/'.$product->image )}}" alt="{{ $product->name_en}}"></a>
                                                <a href="#">{{ $product->name }}</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('wishlists.destroy',$product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">There are no items !</div>
                                        @endforelse
                                    </tbody>
                                   
                                </table>
                            </div>
                            <!-- /.table-responsive-->
                        
                        @else
                            <div class="alert alert-danger">There are no items !</div>
                        @endif
                        

                        @if ($wislists->count() > 0)
                        <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                            <div class="left">
                                <form action="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <button class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                </form>
                            </div> 
                        </div>
                        @endif
                        
                    </div>
                    <!-- /.box-->
                  
                </div>
               
                <!-- /.col-md-3-->
            </div>
        </div>
    </div>
</div>
@endsection
