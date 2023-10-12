@extends('website.layouts.master')
@section('title','Profile')
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
                            <li aria-current="page" class="breadcrumb-item active">Profile</li>
                        </ol>
                    </nav>
                    @include('website.includes.message')
                </div>
                <div class="col-lg-6">
                    <div class="box">
                        <h1>Profile Information</h1>
                        <hr>
                        <form action="{{ route('profile.update')}}" method="post">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" value="{{ Auth::user()->name }}" name="name" class="form-control">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" value="{{ Auth::user()->email }}" name="email" class="form-control">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="box">
                        <h1>Address Information</h1>
                        <hr>
                        <form action="{{ route('profile.updateAddress') }}" method="post">
                            
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="city">City</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    @foreach ($cities as $city)
                                        <option
                                         @if (!empty($city->regions[0]->city_id)) {{ $city->regions[0]->city_id == $city->id ? 'selected' : '' }} @endif value="{{ $city->id }}">
                                            {{ $city->name }}</option>
                                    @endforeach
                                   
                                </select>
                                @error('city_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="region">Region</label>
                                <select name="region_id" id="region_id" class="form-control">
                                    @foreach ($regions as $region)
                                       
                                        <option  @if (!empty($user->addresses[0]->region_id)) {{ $user->addresses[0]->region_id == $region->id ? 'selected' : '' }}  @endif value="{{ $region->id }}">
                                            {{ $region->name }}</option>
                                       
                                   
                                    @endforeach
                                </select>
                                @error('region_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="col-4">
                                    <label for="name">Street</label>
                                    <input id="name" type="text" name="street" class="form-control"
                                        @if (!empty($user->addresses[0]->street))
                                            value="{{ $user->addresses[0]->street }}"
                                        @endif>
                                    @error('street')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="name">Building</label>
                                    <input id="name" type="text" name="building" class="form-control"
                                        @if (!empty($user->addresses[0]->building))
                                            value="{{ $user->addresses[0]->building }}"
                                        @endif>
                                    @error('building')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="name">Floor</label>
                                    <input id="name" type="text" name="floor" class="form-control"
                                        @if (!empty($user->addresses[0]->floor))
                                            value="{{ $user->addresses[0]->floor }}"
                                        @endif>
                                    @error('floor')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="note">Note</label>
                                <input id="note" type="text" name="note" class="form-control">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
