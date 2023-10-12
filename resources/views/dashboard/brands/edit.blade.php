@extends('dashboard.layouts.master')
@section('title','Edit brand')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">Name En</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $brand->name_en }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">Name Ar</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $brand->name_ar }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $brand->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $brand->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="Category">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option {{$brand->category_id == $category->id ? 'selected':''}} value="{{ $category->id }}">{{$category->name_en}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('storage/brands/' . $brand->image) }}" alt="{{ $brand->name_en }}"
                            class="w-100">
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
