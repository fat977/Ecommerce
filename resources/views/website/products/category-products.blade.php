@extends('website.layouts.master')
@section('title','Category Products')
@section('content')
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('website/category_products.home') }}</a></li>
                            <li aria-current="page" class="breadcrumb-item active">{{ $category->section->name }}</li>
                            <li aria-current="page" class="breadcrumb-item active">{{ $category->name }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <!--
            *** MENUS AND FILTERS ***
            _________________________________________________________
            -->

                    <div class="card sidebar-menu mb-4">
                        <div class="card-header">
                            <h3 class="h4 card-title">Brands <a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-times-circle"></i> Clear</a></h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    @foreach ($category->brands as $brand)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="{{ $brand->name_en }}"> {{ $brand->name_en }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>
                            </form>
                        </div>
                    </div>
                    {{-- @foreach ($products as $product )
                        @foreach ($product->specs as $spec )
                        <div class="card sidebar-menu mb-4">
                            <div class="card-header">
                                <h3 class="h4 card-title">{{ $spec->name_en }} <a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-times-circle"></i> Clear</a></h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"><span class="colour white"></span> {{ $spec->pivot->value }}
                                </label>
                            </div>

                        </div>
                        <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>
                    </form>
                </div>
            </div>
            @endforeach
            @endforeach --}}
            <!-- *** MENUS AND FILTERS END ***-->
            <div class="banner"><a href="#"><img src="{{ asset('assets/website/img/banner.jpg') }}" alt="sales 2014" class="img-fluid"></a></div>
        </div>
        <div class="col-lg-9">
            <div class="box">
                <h1>{{ $category->section->name }}</h1>
                <p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>
            </div>
            <div class="box info-bar">
                <div class="row">
                    <div class="col-md-12 col-lg-4 products-showing">Showing <strong>12</strong> of <strong>25</strong> products</div>
                    <div class="col-md-12 col-lg-7 products-number-sort">
                        <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                            <div class="products-number"><strong>Show</strong><a href="#" class="btn btn-sm btn-primary">12</a><a href="#" class="btn btn-outline-secondary btn-sm">24</a><a href="#" class="btn btn-outline-secondary btn-sm">All</a><span>products</span></div>
                            <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
                                <select name="sort-by" class="form-control">
                                    <option>Price</option>
                                    <option>Name</option>
                                    <option>Sales first</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row products">
                @forelse ($products as $product)
                <div class="col-lg-4 col-md-6">
                    <div class="product">
                        <div class="flip-container">
                            <div class="flipper">
                                <div class="front"><a href="{{ route('product.details',$product->id )}}"><img src="{{ asset('storage/products/'.$product->image )}}" alt="{{ $product->name }}" style="height: 300px" class="img-fluid w-100"></a></div>
                                <div class="back"><a href="{{ route('product.details',$product->id) }}"><img src="{{ asset('storage/products/'.$product->image )}}" alt="{{ $product->name }}" style="height: 300px" class="img-fluid w-100"></a></div>
                            </div>
                        </div><a href="{{ route('product.details',$product->id) }}" class="invisible"><img src="{{ asset('storage/products/'.$product->image )}}" alt="{{ $product->name }}" style="height: 300px" class="img-fluid w-100"></a>
                        <div class="text">
                            <h3><a href="{{ route('product.details',$product->id) }}">{{ $product->name }}</a></h3>
                           
                                @foreach ($discountedProducts as $sale)
                                @if ($sale->name == $product->name)
                                    <div class="ribbon sale">
                                        <div class="theribbon">SALE</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                                    <p class="price">
                                        <del>${{ $product->price}}</del>
                                        ${{$sale->price_after_discount}}.00  
                                    </p>  
                                                                      
                                @endif
                                @endforeach
                                <p class="price">${{ $product->price}}</p>
                           
                            
                            <p class="buttons"><a href="{{ route('product.details',$product->id) }}" class="btn btn-outline-secondary">{{ __('website/category_products.details') }}</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>{{ __('website/category_products.cart') }}</a></p>
                        </div>
                        <!-- /.text-->
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
                    <!-- /.product            -->
                </div>
                @empty
                <div class="text-danger">
                    <p class="text-center"></p>There are no products yet !
                </div>
                @endforelse
                <!-- /.products-->
            </div>
            <div class="pages">
                <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a></p>
                <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item"><a href="#" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /.col-lg-9-->
    </div>
</div>
</div>
</div>
@endsection
