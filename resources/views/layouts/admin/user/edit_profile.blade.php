@extends('layouts.admin')
@section('content')

 <div class="row">
    <div class="col-lg-4">
       <div class="card">
        <div class="card-header bg-primary">
            <h3 class="text-white">Update Profile</h3>
        </div>
        <div class="card-body">
            @if(session('status'))
              <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <form action="{{ route('update.profile') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                </div>
                <div class="mb-3">
                    <button type='submit' class="btn btn-primary">submit</button>
                </div>
            </form>
        </div>
       </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Change Password</h3>
            </div>
            <div class="card-body">
                @if(session('update'))
                   <div class="alert alert-success">{{ session('update') }}</div>
                @endif
                <form action="{{ route('update.password') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                        @error('current_password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        @if (session('err'))
                           <strong class="text-danger">{{ session('err') }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                           <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password_confirmation')
                           <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type='submit' class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Update Photo</h3>
            </div>
            <div class="card-body">
                @if(session('photo'))
                   <div class="alert alert-success">{{ session('photo') }}</div>
                @endif
                <form action="{{ route('update.photo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class='form-label'>Upload Photo</label>
                        <input type="file" class="form-control" name="photo"   onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('photo')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class='my-2'>
                        <img id="blah" src="{{ asset('uploads/user') }}/{{ Auth::user()->photo }}" alt="" width="100" />
                    </div>
                    <div class="mb-3">
                        <button type='submit' class="btn btn-primary">Update Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection

