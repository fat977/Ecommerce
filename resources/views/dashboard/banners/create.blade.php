@extends('dashboard.layouts.master')
@section('title','Create a new banner')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="alt">ALT</label>
                        <input type="text" name="alt" id="alt" class="form-control" value="{{old('alt')}}">
                        @error('alt')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{old('status') == 1 ? 'selected':''}} value="1">Active</option>
                            <option {{old('status') == 0 ? 'selected':''}} value="0">Not Active</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100" name="page" value="index"> Create </button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-dark w-100" name="page" value="back"> Create & return </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
