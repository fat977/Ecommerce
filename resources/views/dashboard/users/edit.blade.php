@extends('dashboard.layouts.master')
@section('title','Edit user')

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        @include('dashboard.includes.message')
        <div class="col-12">
            <form action="{{ route('admin.users.update',$user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-6">
                        <label>is banned</label>
                        <select class="form-control" name="is_banned">
                            <option value="0" {{ $user->is_banned == 0 ? 'selected' : '' }}>active
                            </option>
                            <option value="1" {{ $user->is_banned == 1 ? 'selected' : '' }}>banned
                            </option>
                        </select>
                        @error('is_banned')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>banned until</label>
                        <input type="datetime-local" name="banned_until" class="form-control"
                            value="{{ old('banned_until', $user->banned_until) }}">
                        @error('banned_until')
                            <p class="text-danger">{{ $message }}</p>
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
