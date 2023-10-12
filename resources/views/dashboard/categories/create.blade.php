@extends('dashboard.layouts.master')
@section('title','Create a new category')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">Name En</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" value="{{old('name_en')}}">
                        @error('name_en')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">Name Ar</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{old('name_ar')}}">
                        @error('name_ar')
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
                    <div class="col-6">
                        <label for="sections">Sections</label>
                        <select name="section_id" id="sections" class="form-control">
                            @foreach ($sections as $section)
                                <option {{old('section_id') == $section->id ? 'selected':''}} value="{{ $section->id }}">{{$section->name_en}}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>  
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
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
