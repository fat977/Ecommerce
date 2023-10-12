@extends('dashboard.layouts.master')
@section('title','Brands')
<!-- DataTables -->
@include('dashboard.includes.data_tables.css')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name_en}}</td>
                        <td>{{$brand->category->name_en}}</td>
                        <td> <span class="badge badge-{{$brand->status == 0 ? 'danger' : 'success'}} text-center">{{$brand->status == 0 ? 'Not Active' : 'Active'}}</span></td>
                        <td>{{$brand->created_at}}</td>
                        <td>
                            <a href="{{route('admin.brands.edit',$brand->id)}}" class="btn btn-warning">Edit</a>
                             <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-delete-{{ $brand->id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $brand->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this brand ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
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
