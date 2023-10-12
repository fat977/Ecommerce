<?php
use App\Models\Section;
$sections = Section::sections();
?>
<nav class="navbar navbar-expand-lg">
    <div class="container"><a href="{{ route('website') }}" class="navbar-brand home"><img src="{{ asset('assets/website/img/logo.png') }}" alt="Obaju logo" class="d-none d-md-inline-block"><img src="img/logo-small.png" alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">Obaju - go to homepage</span></a>
        <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.html" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
        </div>
        <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="{{ route('website') }}" class="nav-link active">{{ __('website/navbar.home') }}</a></li>
                @foreach ($sections as $section)
                <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">{{ $section->name }}<b class="caret"></b></a>
                    <ul class="dropdown-menu megamenu">
                        <li>
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <ul class="list-unstyled mb-3">
                                        @foreach ($section->categories as $category)
                                        <li class="nav-item"><a href="{{ route('product.category',$category->id) }}" class="nav-link">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @endforeach
                <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">{{ __('website/navbar.tempelate') }}<b class="caret"></b></a>
                    <ul class="dropdown-menu megamenu">
                        <li>
                            <div class="row">
                                @auth
                                <div class="col-md-6 col-lg-3">
                                    <h5>{{ __('website/navbar.users') }}</h5>
                                    <ul class="list-unstyled mb-3">
                                        @auth
                                        <li class="nav-item"><a href="{{ route('order.history') }}" class="nav-link">{{ __('website/navbar.user.order_history') }}</a></li>
                                        <li class="nav-item"><a href="customer-order.html" class="nav-link">{{ __('website/navbar.user.order_history_details') }}</a></li>
                                        <li class="nav-item"><a href="{{ route('wishlists.index') }}" class="nav-link">{{ __('website/navbar.user.wishlist') }}</a></li>
                                        @endauth
                                    </ul>
                                </div>
                                @endauth
                                @auth
                                <div class="col-md-6 col-lg-3">
                                    <h5>{{ __('website/navbar.orders_process') }}</h5>
                                    <ul class="list-unstyled mb-3">
                                        <li class="nav-item"><a href="{{ route('carts.index') }}" class="nav-link">{{ __('website/navbar.order_process.cart') }}</a></li>
                                        <li class="nav-item"><a href="{{ route('order.checkout') }}" class="nav-link">{{ __('website/navbar.order_process.checkout') }}</a></li>
                                    </ul>
                                </div>
                                @endauth
                               {{--  <div class="col-md-6 col-lg-3">
                                    <h5>Pages and blog</h5>
                                    <ul class="list-unstyled mb-3">
                                        <li class="nav-item"><a href="blog.html" class="nav-link">Blog listing</a></li>
                                        <li class="nav-item"><a href="post.html" class="nav-link">Blog Post</a></li>
                                        <li class="nav-item"><a href="faq.html" class="nav-link">FAQ</a></li>
                                        <li class="nav-item"><a href="text.html" class="nav-link">Text page</a></li>
                                        <li class="nav-item"><a href="text-right.html" class="nav-link">Text page - right sidebar</a></li>
                                        <li class="nav-item"><a href="404.html" class="nav-link">404 page</a></li>
                                        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-buttons d-flex justify-content-end">
                <!-- /.nav-collapse-->
                <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
                <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="basket.html" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span>3 items in cart</span></a></div>
            </div>
        </div>
    </div>
</nav>
<div id="search" class="collapse">
    <div class="container">
        <form role="search" class="ml-auto">
            <div class="input-group">
                <input type="text" placeholder="Search" class="form-control">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
