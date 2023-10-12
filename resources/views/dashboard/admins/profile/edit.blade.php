@extends('dashboard.layouts.master')
@section('title','Profile')
@section('content')
<div class="content-wrapper">
    @include('dashboard.includes.message')
    <div id="logins-part" class="content p-3" role="tabpanel" aria-labelledby="logins-part-trigger">
        <h3>Profile Information</h3>
        <p>Update your account's profile information and email address.</p>
        <form action="{{ route('admin.profile.updatePersonalData',$admin->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-4 offset-4">
                @if (empty($admin->image))
                    <img src="{{ asset('storage/avatars/default.png') }}" alt="User Image" id="image" width="50%" class=" rounded-circle" style="cursor: pointer;">
                @else
                    <img src="{{ asset('storage/avatars/'.$admin->image) }}" alt="User Image" id="image" width="50%" class="rounded-circle" style="cursor: pointer;">
                @endif
                <input type="file" name="image" id="file" class="d-none">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="{{ $admin->name }}" name="name" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="{{ $admin->email }}" name="email" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <button class="btn btn-dark">Save</button>
        </form>
    </div>

    <div id="logins-part" class="content p-3" role="tabpanel" aria-labelledby="logins-part-trigger">
        <h3>Update Password</h3>
        <p>Ensure your account is using a long, random password to stay secure.</p>
        <form action="{{ route('admin.profile.updatePassword',$admin->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Current Password</label>
                <input type="password" class="form-control  @error('current_password') is-invalid @enderror" name="current_password">
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">New Password</label>
                <input type="password" class="form-control  @error('new_password') is-invalid @enderror" name="new_password">
                @error('new_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Confirm Password</label>
                <input type="password" class="form-control  @error('confirm_password') is-invalid @enderror" name="confirm_password">
                @error('confirm_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
           
            <button class="btn btn-dark">Save</button>
        </form>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ asset('assets/plugins/jquery-1.12.0.min.js') }}"></script>
    <script>
        $('#image').on('click', function() {
            $('#file').click();
        });
    </script>
@endsection
