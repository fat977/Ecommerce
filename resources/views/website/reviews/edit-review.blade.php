@extends('website.layouts.master')
@section('title','Edit Review')
@section('content')
<div id="all">
    <div id="content">
        <div class="container">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p><b>Write Your Review for <a href="{{ route('product.details',$product->id) }}"> {{ $product->name_en }}</a></b></p>
                        @include('website.includes.message')
                        <form action="{{ route('review.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $existing_review->product_id }}">                               
                            <textarea cols="50" class="form-control" name="review" >{{ $existing_review->review }}</textarea>                             
                            <div class="rating-css">
                                <div class="star-icon">
                                    @if ($existing_review)
                                        @for ($i = 1; $i <= $existing_review->value; $i++)
                                            <input type="radio" value="{{ $i }}" name="value" checked id="rating{{ $i }}">
                                            <label for="rating{{ $i }}" class="fa fa-star checked"></label>
                                        @endfor
                                        @for ($j = $existing_review->value+1 ; $j <= 5; $j++)
                                            <input type="radio" value="{{ $j }}" name="value" id="rating{{ $j }}">
                                            <label for="rating{{ $j }}" class="fa fa-star not-checked"></label>
                                        @endfor
                                    @else
                                        <input type="radio" value="1" name="value" checked id="rating1">
                                        <label for="rating1" class="fa fa-star"></label>
                                        <input type="radio" value="2" name="value" id="rating2">
                                        <label for="rating2" class="fa fa-star"></label>
                                        <input type="radio" value="3" name="value" id="rating3">
                                        <label for="rating3" class="fa fa-star"></label>
                                        <input type="radio" value="4" name="value" id="rating4">
                                        <label for="rating4" class="fa fa-star"></label>
                                        <input type="radio" value="5" name="value" id="rating5">
                                        <label for="rating5" class="fa fa-star"></label>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <button style="margin-top: 0px" type="submit" class="btn btn-primary">
                                Update Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
