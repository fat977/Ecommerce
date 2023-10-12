@extends('dashboard.layouts.master')
@section('title','Edit a product offers')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.offer.update',[$data->product_id,$data->offer_id]) }}" method="POST">
                @csrf
                <div class="col-6">
                    <label for="value">product</label>
                    <input type="text" name="product_id" class="form-control" value="{{ $data->product_id }}">
                    @error('product_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="name_en">offer</label>
                    <select class="form-control" data-placeholder="choose offer" name="offer_id"
                        style="width: 100%;">
                        @foreach ($offers as $offer)
                            <option value="{{ $offer->id }}"
                                {{ collect(old('offer_id'))->contains($offer->id) ? 'selected' : '' }}>
                                {{ $offer->title_en }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" value="{{ $data->price}}">
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100" value="index"> Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
