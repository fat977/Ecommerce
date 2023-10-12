@extends('dashboard.layouts.master')
@section('title','Banners')
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
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                    <tr>
                        <td>{{$banner->id}}</td>
                        <td> <img src="{{ asset('storage/banners/' . $banner->image) }}" alt="{{ $banner->alt }}"
                            style="width: 300px; height:100px"></td>
                        <td> <span class="badge badge-{{$banner->status == 0 ? 'danger' : 'success'}} text-center">{{$banner->status == 0 ? 'Not Active' : 'Active'}}</span></td>
                        <td>
                            <a href="{{route('admin.banners.edit',$banner->id)}}" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-{{ $banner->id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $banner->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this banner ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST">
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
