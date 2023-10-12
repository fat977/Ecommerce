@extends('dashboard.layouts.master')
@section('title','Admins')
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
                        <th>Status</th>
                        <th>Type</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td> <span class="badge badge-{{$admin->status == 0 ? 'danger' : 'success'}} text-center">{{$admin->status == 0 ? 'Not Active' : 'Active'}}</span></td>
                        <td>{{ $admin->type }}</td>
                        <td>{{$admin->created_at}}</td>
                        <td>
                            @can('update',  App\Models\Admin::class)

                            <a href="{{route('admin.admins.edit',$admin->id)}}" class="btn btn-warning">Edit</a>
                            @endcan
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-delete-{{ $admin->id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $admin->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this admin ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST">
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
