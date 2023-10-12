@extends('dashboard.layouts.master')
@section('title','Edit banner')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <div class="form-row">
                    <div class="col-12">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('storage/banners/' . $banner->image) }}" alt="{{ $banner->alt }}"
                            class="w-100">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="alt">ALT</label>
                        <input type="text" name="alt" id="alt" class="form-control" value="{{$banner->alt}}">
                        @error('alt')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $banner->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $banner->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100"> Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
