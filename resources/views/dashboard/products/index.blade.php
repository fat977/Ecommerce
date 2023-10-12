@extends('dashboard.layouts.master')

@section('title', 'Produts')

@section('css')
<!-- DataTables -->
@include('dashboard.includes.data_tables.css')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <form action="{{ route('admin.product.import')}}" method="post">
            @csrf
            <input type="file" name="file">
            <button class="btn btn-primary"> Import</button>
        </form>
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name_en}}</td>
                        <td>{{$product->category->name_en}}</td>
                        <td>{{$product->brand->name_en}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td> <span class="badge badge-{{$product->status == 0 ? 'danger' : 'success'}} text-center">{{$product->status == 0 ? 'Not Active' : 'Active'}}</span></td> 
                        <td>
                            <a href="{{route('admin.products.show',$product->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('admin.spec.create',$product->id)}}" title="add specs to product" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i></a>
                            <a href="{{route('admin.offer.create',$product->id)}}" title="add offers to product" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-{{ $product->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $product->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this product ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-md">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
@include('dashboard.includes.data_tables.js')
@endsection
