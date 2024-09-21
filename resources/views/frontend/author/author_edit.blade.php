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
  </div>
@endsection
