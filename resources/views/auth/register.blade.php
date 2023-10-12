@extends('website.layouts.master')
@section('title','Register')
@section('content')
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('website/auth.home') }}</a></li>
                            <li aria-current="page" class="breadcrumb-item active">{{ __('website/auth.new_account') }} / {{ __('website/auth.login') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6">
                    <div class="box">
                        <h1>{{ __('website/auth.new_account') }}</h1>
                       
                        <hr>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('website/auth.fields.name') }}</label>
                                <input id="name" type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('website/auth.fields.email') }}</label>
                                <input id="email" type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('website/auth.fields.password') }}</label>
                                <input id="password" type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('website/auth.fields.confirm_password') }}</label>
                                <input id="password" type="password" name="password_confirmation" class="form-control">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i>{{ __('website/auth.buttons.register') }}</button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <h3>or</h3>
                            <br>
                            <a class="p-2 btn btn-primary" href="{{ url('auth/facebook') }}" style="margin-top: 0px !important;background: blue;color: #ffffff;padding: 5px;border-radius:7px;" id="btn-fblogin">
                                <i class="fab fa-facebook mx-1 px-1" aria-hidden="true"></i> Login with Facebook
                            </a>
                            <a class="p-2 btn btn-danger" href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: #C84130;color: #ffffff;padding: 5px;border-radius:7px;">
                                <i class="fab fa-google mx-1 px-1"></i>Login with Google
                            </a> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="box">
                        <h1>{{ __('website/auth.login') }}</h1>
                       
                        <hr>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('website/auth.fields.email') }}</label>
                                <input id="email" type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('website/auth.fields.password') }}</label>
                                <input id="password" type="password" name="password" class="form-control">
                            </div>
                            <!-- Remember Me -->
                            <div class="form-group">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('website/auth.remember_me') }}</span>
                                </label>
                            </div>

                            <div class="form-group">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('website/auth.forgot_password') }}
                                </a>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i>{{ __('website/auth.buttons.login') }}</button>
                            </div>

                            
                        </form>
                        <div class="text-center mt-4">
                            <h3>or</h3>
                            <br>
                            <a class="p-2 btn btn-primary" href="{{ url('auth/facebook') }}" style="margin-top: 0px !important;background: blue;color: #ffffff;padding: 5px;border-radius:7px;" id="btn-fblogin">
                                <i class="fab fa-facebook mx-1 px-1" aria-hidden="true"></i> Login with Facebook
                            </a>
                            <a class="p-2 btn btn-danger" href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: #C84130;color: #ffffff;padding: 5px;border-radius:7px;">
                                <i class="fab fa-google mx-1 px-1"></i>Login with Google
                            </a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
