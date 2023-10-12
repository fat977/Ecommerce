@extends('dashboard.layouts.master')
@section('title','Edit admin')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.admins.update',$admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <label for="Status">Status</label>
                    <select name="status" id="Status" class="form-control">
                        <option {{ $admin->status == 1 ? 'selected' : '' }} value="1">Active</option>
                        <option {{ $admin->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option {{ $admin->type == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                            <option {{ $admin->type == 'super admin' ? 'selected' : '' }} value="super admin">Super Admin</option>
                        </select>
                        @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100"> Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
