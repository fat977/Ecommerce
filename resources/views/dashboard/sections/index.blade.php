@extends('dashboard.layouts.master')
@section('title','Sections')
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
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                    <tr>
                        <td>{{$section->id}}</td>
                        <td>{{$section->name_en}}</td>
                        <td> <span class="badge badge-{{$section->status == 0 ? 'danger' : 'success'}} text-center">{{$section->status == 0 ? 'Not Active' : 'Active'}}</span></td>
                        <td>{{$section->created_at}}</td>
                        <td>
                            <a href="{{route('admin.sections.edit',$section->id)}}" class="btn btn-warning">Edit</a>
                             <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-delete-{{ $section->id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $section->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this section ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.sections.destroy', $section->id) }}" method="POST">
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
