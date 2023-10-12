@extends('website.layouts.master')
@section('title','Product Details')
@section('content')
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('website/product_details.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $product->category->section->name }}</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
                            <li aria-current="page" class="breadcrumb-item active">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-12 order-1 order-lg-2">
                    <div id="productMain" class="row">
                        <div class="col-md-6">
                            <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                                <div class="item"> <img src="{{ asset('storage/products/'.$product->image ) }}" alt="{{ $product->name }}" style="height: 500px" class="img-fluid"></div>
                                <div class="item"> <img src="{{ asset('storage/products/'.$product->image ) }}" alt="{{ $product->name }}"  style="height: 500px" class="img-fluid"></div>
                                <div class="item"> <img src="{{ asset('storage/products/'.$product->image ) }}" alt="{{ $product->name }}"  style="height: 500px" class="img-fluid"></div>
                            </div>
                            @foreach ($discountedProducts as $sale)
                                @if ($sale->name == $product->name)
                                    <div class="ribbon sale">
                                        <div class="theribbon">SALE</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                                @endif
                            @endforeach
                            <!-- /.ribbon-->
                            @foreach ($newProducts as $new)
                            @if ($new->name == $product->name)
                            <div class="ribbon new">
                                <div class="theribbon">NEW</div>
                                <div class="ribbon-background"></div>
                            </div>
                            @endif
                            @endforeach
                            <!-- /.ribbon-->
                        </div>
                        <div class="col-md-6">
                            @include('website.includes.message')
                            <div class="box">
                                <h1 class="text-center">{{ $product->name }}</h1>
                                <div class="text-center">
                                    @php
                                        $rate_num = number_format($rating_avg)
                                    @endphp
                                    <td>
                                        @for ($i = 1; $i <= $rate_num; $i++)
                                            <i class="fa fa-star checked"></i>
                                        @endfor
                                        @for ($j = $rate_num; $j < 5; $j++)
                                            <i class="fa fa-star not-checked"></i>
                                        @endfor
                                        
                                    </td>
                                    <td>
                                        @if ($rating > 0)
                                            <span>{{ $rating }} Rating</span>
                                        @else
                                            No Rating
                                        @endif
                                        
                                    </td>
                                </div>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material &amp; care and sizing</a></p>
                                @foreach ($discountedProducts as $sale)
                                    @if ($sale->name == $product->name)
                                        <p class="price">
                                            <del>${{ $product->price}}</del>
                                            ${{$sale->price_after_discount}}.00
                                        </p>
                                    @endif
                                @endforeach
                                <p class="price">${{ $product->price}}</p>
                                @if ($product->quantity > 0)
                                <h4 class="text-center text-success"> Available : {{ $product->quantity }} in stock</h4>
                                <div class="{{-- row d-flex justify-content-center my-3 --}}">
                                    
                                    <div class="row -flex justify-content-center">
                                        <form action="{{ route('carts.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                                           
                                            <div class="text-center my-3">
                                                <select class="form-control form-select-sm" name="quantity">
                                                    <option selected>Qty :1</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                                
                                            <button class="btn btn-primary"><i class="fa fa-shopping-cart"></i> {{ __('website/product_details.cart') }}</button>
                                        </form>
                                    </div>
                                    

                                </div>
                                @else
                                <h4 class="text-center text-danger"> out of stock</h4>
                                @endif
                                <div class="row -flex justify-content-center my-3">
                                    <form action="{{ route('wishlists.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <button class="btn btn-outline-primary"><i class="fa fa-heart"></i> {{ __('website/product_details.wishlist') }}</button>
                                    </form>
                                </div>
                            </div>
                            <div data-slider-id="1" class="owl-thumbs">
                                <button class="owl-thumb-item"><img src="img/detailsquare.jpg" alt="" class="img-fluid"></button>
                                <button class="owl-thumb-item"><img src="img/detailsquare2.jpg" alt="" class="img-fluid"></button>
                                <button class="owl-thumb-item"><img src="img/detailsquare3.jpg" alt="" class="img-fluid"></button>
                            </div>
                        </div>
                    </div>
                    <div id="details" class="box">
                        <p></p>
                        <h4>{{ __('website/product_details.product_details') }}</h4>
                        <p>{{ $product->desc }}</p>
                        <table id="example1" class="table table-bordered table-striped">
                            <tbody>
                                @forelse ($product->specs as $spec)
                                <tr>
                                    <th colspan="1">{{ $spec->name}}</th>
                                    <td colspan="2">{{$spec->pivot->value}}</td>
                                </tr>
                                @empty
                                <p class="text-center">There are no specs yet</p>
                                @endforelse
                            </tbody>
                        </table>

                        <hr>

                        <div class="social">
                            <h4>Show it to your friends</h4>
                            <p><a href="#" class="external facebook"><i class="fa-brands fa-facebook"></i></i></a><a href="#" class="external gplus"><i class="fa-brands fa-google-plus"></i></a><a href="#" class="external twitter"><i class="fa-brands fa-twitter"></i></a><a href="#" class="email"><i class="fa fa-envelope"></i></a></p>
                        </div>
                    </div>

                    <div class="box">
                        @auth
                        @if (! $user_rating)
                            <form action="{{ route('reviews.store') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <div class="rating-css">
                                    <div class="star-icon">
                                        <b style="color:black; font-size:15px">Rating: </b>   
                                        @if ($user_rating)
                                            @for ($i = 1; $i <= $user_rating->value; $i++)
                                                <input type="radio" value="{{ $i }}" name="product_rating" checked id="rating{{ $i }}">
                                                <label for="rating{{ $i }}" class="fa fa-star"></label>
                                            @endfor
                                            @for ($j = $user_rating->value+1 ; $j <= 5; $j++)
                                                <input type="radio" value="{{ $j }}" name="product_rating" id="rating{{ $j }}">
                                                <label for="rating{{ $j }}" class="fa fa-star"></label>
                                            @endfor
                                        @else
                                            <input type="radio" value="1" name="product_rating" checked id="rating1">
                                            <label for="rating1" class="fa fa-star"></label>
                                            <input type="radio" value="2" name="product_rating" id="rating2">
                                            <label for="rating2" class="fa fa-star"></label>
                                            <input type="radio" value="3" name="product_rating" id="rating3">
                                            <label for="rating3" class="fa fa-star"></label>
                                            <input type="radio" value="4" name="product_rating" id="rating4">
                                            <label for="rating4" class="fa fa-star"></label>
                                            <input type="radio" value="5" name="product_rating" id="rating5">
                                        <label for="rating5" class="fa fa-star"></label>
                                        @endif
                                    </div>
                                </div>
                                <textarea class="form-control" name="review" cols="100" rows="5" placeholder="Write a review.."></textarea>
                                <button class="btn btn-outline-primary my-3">Submit</button>
                            </form>
                        @endif   
                        @endauth 

                        <div class="col-md-12" style="margin-top:30px">
                            <h3>{{ __('website/product_details.reviews') }}</h3>
                            @if (count($reviews) > 0)
                                @foreach ($reviews as $review)
                                    <div class="user-review">
                                        <div class="row">
                                            @if ($review->user_id == Auth::id())
                                            <div class="col-2"><label for="name"><i class="fa fa-user"></i> {{ $product->user_reviews[0]->name }}</label></div>
                                            <div class="col-10">
                                                <form action="{{ route('review.delete')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">                               
                                                    <a class="btn btn-primary" href="{{ route('reviews.edit',$product->id) }}">Edit</a>
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                        </div>
                                       

                                       <br>
                                       <label><i class="fa fa-calendar-o"></i> {{ __('website/product_details.review_on') }} ({{ $review->created_at->format('d M Y') }})</label>
                                        <br>
                                     
                                            @php
                                                $user_rated = $review->value
                                            @endphp
                                            @for ($i = 1; $i <= $user_rated; $i++)
                                                <i class="fa fa-star checked" style="margin-top:0"></i>
                                            @endfor
                                            @for ($j = $user_rated+1; $j <= 5; $j++)
                                                <i class="fa fa-star not-checked" style="margin-top:0"></i>
                                            @endfor
                                        <br><br>
                                    
                                        <P>{{ $review->review }}</P>
                                    </div>
                                @endforeach
                            @else
                                <h5 class="text-center">There is no reviews to show</h5>
                            @endif

                        </div>
                    </div>

                    <div class="row same-height-row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box same-height">
                                <h3>You may also like these products</h3>
                            </div>
                        </div>
                        @foreach ($similarProducts as $product)
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="{{ route('product.details',$product->id )}}"><img src="{{ asset('storage/products/'.$product->image )}}" alt="{{ $product->name }}" style="height: 300px" class="img-fluid w-100"></a></div>
                                        <div class="back"><a href="{{ route('product.details',$product->id )}}"><img src="{{ asset('storage/products/'.$product->image )}}" alt="{{ $product->name }}" style="height: 300px" class="img-fluid w-100"></a></div>
                                    </div>
                                </div><a href="{{ route('product.details',$product->id )}}" class="invisible"><img src="{{ asset('storage/products/'.$product->image )}}" alt="{{ $product->name }}" style="height: 300px" class="img-fluid w-100"></a>
                                <div class="text">
                                    <h3>{{ $product->name }}</h3>
                                    <p class="price">${{ $product->price }}</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                        @endforeach
                    </div>
                    <div class="row same-height-row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box same-height">
                                <h3>Products viewed recently</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product2.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product2_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product2.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3>Fur coat</h3>
                                    <p class="price">$143</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product1.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product1_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product1.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3>Fur coat</h3>
                                    <p class="price">$143</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img src="img/product3.jpg" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img src="img/product3_2.jpg" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img src="img/product3.jpg" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3>Fur coat</h3>
                                    <p class="price">$143</p>
                                </div>
                            </div>
                            <!-- /.product-->
                        </div>
                    </div>
                </div>
                <!-- /.col-md-9-->
            </div>
        </div>
    </div>
</div>
@endsection
