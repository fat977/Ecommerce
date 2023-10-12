@extends('dashboard.layouts.master')
@section('title','Create a new product specs')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.spec.store',$product->id) }}" method="POST">
                @csrf
                <div class="col-6">
                    <label for="value">product</label>
                    <input type="text" name="product_id" id="value" class="form-control" value="{{ $product->id }}">
                    @error('product_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="name_en">Spec</label>
                    <select class="form-control" data-placeholder="choose spec" name="spec_id"
                        style="width: 100%;">
                        @foreach ($specs as $spec)
                            <option value="{{ $spec->id }}"
                                {{ collect(old('spec_id'))->contains($spec->id) ? 'selected' : '' }}>
                                {{ $spec->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="value">Value</label>
                    <input type="text" name="value" id="value" class="form-control" value="{{old('value')}}">
                    @error('value')
                        <p class="text-danger">{{ $message }}</p>
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
