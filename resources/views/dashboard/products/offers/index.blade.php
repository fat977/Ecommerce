@extends('dashboard.layouts.master')
@section('title','Offers')
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
                        <th>Discount</th>
                        <th>Start at</th>
                        <th>End at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                    <tr>
                        <td>{{$offer->id}}</td>
                        <td>{{$offer->title_en}}</td>
                        <td>{{$offer->discount}}</td>
                        <td>{{$offer->start_at}}</td>
                        <td>{{$offer->end_at}}</td>
                        <td>
                            <a href="{{route('admin.offers.edit',$offer->id)}}" class="btn btn-warning">Edit</a>
                             <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-delete-{{ $offer->id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $offer->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">Confirm Delete</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>Are you sure you want to delete this offer ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST">
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
