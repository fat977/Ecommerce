@extends('dashboard.layouts.master')
@section('title','Categories')
@section('css')
<!-- DataTables -->
@include('dashboard.includes.data_tables.css')
@endsection
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
                        <th>Section</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name_en}}</td>
                        <td>{{ $category->section->name_en }}</td>
                        <td> <span class="badge badge-{{$category->status == 0 ? 'danger' : 'success'}} text-center">{{$category->status == 0 ? 'Not Active' : 'Active'}}</span></td>
                        <td>{{$category->created_at}}</td>
                        <td>
                            <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-delete-{{ $category->id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $category->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this category ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
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
