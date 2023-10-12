<div id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center text-lg-right">
                <ul class="menu list-inline mb-0">
                    <li class="list-inline-item">
                        @if (Route::has('login'))
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                @auth
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item text-dark" href="{{ route('profile.edit') }}">{{ __('website/header.profile') }}</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('website/header.logout') }}
                                            </x-dropdown-link>
                                        </form>
                                    </div>
                                </div>
                                @else
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ transl('register_login') }}</a>
                                @endif
                                @endauth
                            </div>
                        @endif
                    </li>
                    <li class="list-inline-item"><a href="contact.html">{{ __('website/header.contact') }}</a></li>
                    <li class="list-inline-item">
                        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="hidden-md-down">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
    
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
    
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{-- <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer login</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="customer-orders.html" method="post">
                        <div class="form-group">
                            <input id="email-modal" type="text" placeholder="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input id="password-modal" type="password" placeholder="password" class="form-control">
                        </div>
                        <p class="text-center">
                            <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                        </p>
                    </form>
                    <p class="text-center text-muted">Not registered yet?</p>
                    <p class="text-center text-muted"><a href="register.html"><strong>Register now</strong></a>! It is easy and done in 1 minute and gives you access to special discounts and much more!</p>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- *** TOP BAR END ***-->


</div>
