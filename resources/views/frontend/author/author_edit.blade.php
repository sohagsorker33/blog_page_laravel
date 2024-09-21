@extends('frontend.author.author_admin_panel')

@section('content')
  <div class="row">
    <div class="col-lg-6">
        <div class="card">
          <div class="card-header bg-info" >
             <h3 class="text-white"> Author Profile Update</h3>
          </div>
          <div class="card-body">
             @if(session('update'))
                <div class="alert alert-success">{{ session('update') }}</div>
             @endif
             <form action="{{ route('author.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                   <label Class="form-label">Name</label>
                   <input type="text" class="form-control" name="name" value="{{ Auth::guard('author')->user()->name }}">
                </div>
                <div class="mb-3">
                    <label Class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ Auth::guard('author')->user()->email }}">
                 </div>
                 <div class="mb-3">
                    <label Class="form-label">Photo</label>
                    <input type="file" class="form-control" name="photo"onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    <div class="my2-">
                        <img src="{{ asset('uploads/author') }}/{{ Auth::guard('author')->user()->photo }}" alt="" id="blah" width="100">
                    </div>
                 </div>
                 <div class="mb-3">
                   <button type="submit" class="btn btn-primary">Update</button>
                 </div>
             </form>
          </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white">Change Password</h3>
            </div>
            <div class="card-body">
                @if(session('change_password'))
                <div class="alert alert-success">{{ session('change_password') }}</div>
                @endif
                <form action="{{ route('author.password.update') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Old Password</label>
                        <input type="password" class="form-control" name="old_password">
                        @if(session('old_password'))
                        <strong class="alert alert-danger">{{ session('old_password') }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="new_password">
                        @if(session('password'))
                        <strong class="alert alert-danger">{{ session('password') }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">change password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
