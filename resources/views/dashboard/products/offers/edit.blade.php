@extends('dashboard.layouts.master')
@section('title','Edit offer')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.offers.update', $offer->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="title_en">Title En</label>
                        <input type="text" name="title_en" id="title_en" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $offer->title_en }}">
                        @error('title_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="title_ar">Title Ar</label>
                        <input type="text" name="title_ar" id="title_ar" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $offer->title_ar }}">
                        @error('title_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label>Start at</label>
                        <input type="datetime-local" name="start_at" class="form-control"
                            value="{{ old('start_at', $offer->start_at) }}">
                        @error('start_at')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="end_at">End at</label>
                        <input type="datetime-local" name="end_at" class="form-control"
                            value="{{ old('end_at', $offer->end_at) }}">
                        @error('end_at')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label for="discount">Discount</label>
                    <input type="text" name="discount" id="discount" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $offer->discount }}">
                    @error('discount')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
