@extends('dashboard.layouts.master')
@section('title', 'Edit Product')
@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            @include('dashboard.includes.message')
        </div>
        <div class="col-12">
            <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">Name En</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $product->name_en }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">Name Ar</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $product->name_ar }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="Price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $product->price }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="Code">Code</label>
                        <input type="number" name="code" id="Code" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $product->code }}">
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="Quantity">Quantity</label>
                        <input type="number" name="quantity" id="Quantity" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $product->quantity }}">
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="Code">Brands</label>
                        <select name="brand_id" id="Code" class="form-control">
                            @foreach ($brands as $brand)
                                <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                    value="{{ $brand->id }}">
                                    {{ $brand->name_en }}</option>
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
                                <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name_en }}</option>
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
                        <textarea name="desc_en" id="desc_en" cols="30" rows="10"
                            class="form-control">{{ $product->desc_en }}</textarea>
                        @error('desc_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="desc_ar">Desc Ar</label>
                        <textarea name="desc_ar" id="desc_ar" cols="30" rows="10"
                            class="form-control">{{ $product->desc_ar }}</textarea>
                        @error('desc_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="image">Image</label>
                        {{-- <input type="file" name="image" id="image" class="form-control"> --}}
                        <input type="file" name="image" id="file" class="d-none">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name_en }}"
                            class="w-100" id="image" name="click" style="cursor: pointer;">
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-warning w-100" name="page" value="index"> Update </button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-dark w-100 " name="page" value="back"> Update & Return </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/jquery-1.12.0.min.js') }}"></script>
    <script>
        $('#image').on('click', function() {
            $('#file').click();
        });
    </script>
@endsection

