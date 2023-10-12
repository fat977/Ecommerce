@extends('dashboard.layouts.master')
@section('title', 'Show Product')
@section('content')
<div class="content-wrapper p-4">
    <div class="row">
        @include('dashboard.includes.message')
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">Product Details</h3>
                </thead>
                <tbody>
                    <tr>
                        <th>Id</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $product->name_en }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $product->category->name_en }}</td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td>{{ $product->brand->name_en }}</td>
                    </tr>
                    <tr>
                        <th>Code</th>
                        <td>{{$product->code}}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{$product->price}}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>{{$product->quantity}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td> <span class="badge badge-{{$product->status == 0 ? 'danger' : 'success'}} text-center">{{$product->status == 0 ? 'Not Active' : 'Active'}}</span></td>
                    </tr>
                    <tr>
                        <th>Create Date</th>
                        <td>{{$product->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td><img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name_en }}" style="width: 40%"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">Product Specs</h3>
                </thead>
                <tbody>
                    @forelse ($product->specs as $spec)
                    <tr>
                        <th>{{ $spec->name_en}}</th>
                        <td>{{$spec->pivot->value}}</td>
                        <td>
                            <a href="{{route('admin.spec.edit',[$spec->pivot->product_id,$spec->pivot->spec_id])}}" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-{{ $spec->pivot->product_id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $spec->pivot->product_id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this product spec ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.spec.delete',[$spec->pivot->product_id,$spec->pivot->spec_id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-dark btn-md">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p class="text-center">There are no specs yet</p>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">Product Offers</h3>
                </thead>
                <tbody>
                    @forelse ($product->offers as $offer)
                    <tr>
                        <th>{{ $offer->title_en}}</th>
                        <td><b>Discount: </b>{{$offer->discount}}</td>
                        <td><b>Product price: </b>{{$offer->pivot->price}}</td>
                        <td>
                            <a href="{{route('admin.offer.edit',[$offer->pivot->product_id,$offer->pivot->offer_id])}}" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-{{ $offer->pivot->product_id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $offer->pivot->product_id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this product offer ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.offer.delete',[$offer->pivot->product_id,$offer->pivot->offer_id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-dark btn-md">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p class="text-center">There are no offers yet</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
