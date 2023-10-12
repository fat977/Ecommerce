@extends('dashboard.layouts.master')
@section('title','Create an admin')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password" class="form-control" value="{{old('password')}}">
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option {{old('type') == 'admin' ? 'selected':''}} value="admin">Admin</option>
                            <option {{old('type') == 'super admin' ? 'selected':''}} value="super admin">Super Admin</option>
                        </select>
                        @error('type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100" name="page" value="index"> Create </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
