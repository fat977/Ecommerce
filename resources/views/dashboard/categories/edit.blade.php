@extends('dashboard.layouts.master')
@section('title','Edit category')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">Name En</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $category->name_en }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">Name Ar</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $category->name_ar }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $category->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $category->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="sections">Sections</label>
                        <select name="section_id" id="sections" class="form-control">
                            @foreach ($sections as $section)
                                <option {{ $category->section_id == $section->id ? 'selected':''}} value="{{ $section->id }}">{{$section->name_en}}</option>
                            @endforeach
                        </select>
                        @error('section_id')
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
                        @if (!empty($category->image))
                            <img src="{{ asset('storage/categories/' . $category->image) }}" alt="{{ $category->name_en }}"
                            class="w-100">                            
                        @endif
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
