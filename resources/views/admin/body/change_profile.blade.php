@extends('admin.admin_master')
    @section('admin')
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>User Profile Details</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update.profile') }}" class="form-pill" enctype="multipart/form-data">
                    @csrf
                        @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">X</button>
                                    </div>
                            @endif
                    {{-- <input type="hidden" name="old_image" value="{{ $user['profile_photo_url'] }}">
                    <div class="form-group">
                        <img src="{{ $user['profile_photo_url'] }}" alt="" width="100px" height="100px" style="border-radius:50%">
                        <br><br> --}}
                        {{-- <label for="exampleFormControlInput3">Profile Photo</label> --}}
                        {{-- <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                    </div> --}}
                    <div class="form-group">
                        <label for="exampleFormControlPassword3">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success w-25">Update</button>
                </form>
            </div>
        </div>
    @endsection
