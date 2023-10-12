@extends('dashboard.layouts.master')
@section('title', 'Create Product')
@section('content')
<div class="content-wrapper p-4">
    <div class="row">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">Name En</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('name_en')}}">
                        @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">Name Ar</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('name_ar')}}">
                        @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="Price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('price')}}">
                        @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="Code">Code</label>
                        <input type="number" name="code" id="Code" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('code')}}">
                        @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="Quantity">Quantity</label>
                        <input type="number" name="quantity" id="Quantity" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('quantity')}}">
                        @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{old('status') == 1 ? 'selected':''}} value="1">Active</option>
                            <option {{old('status') == 0 ? 'selected':''}} value="0">Not Active</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="Code">Brands</label>
                        <select name="brand_id" id="Code" class="form-control">
                            @foreach ($brands as $brand)
                            <option {{ old('brand_id')== $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="category_id">Categories</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $category)
                            <option {{ old('category_id') == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name_en }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="desc_en">Desc En</label>
                        <textarea name="desc_en" id="desc_en" cols="30" rows="10" class="form-control">{{old('desc_en')}}</textarea>
                        @error('desc_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="desc_ar">Desc Ar</label>
                        <textarea name="desc_ar" id="desc_ar" cols="30" rows="10" class="form-control">{{old('desc_ar')}}</textarea>
                        @error('desc_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
