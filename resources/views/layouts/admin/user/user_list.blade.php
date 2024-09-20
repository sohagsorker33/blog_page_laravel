@extends('layouts.admin')

@section('content')
  <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary">
                 <h3 class="text-white">User List</h3>
            </div>
            <div class="card-body">
                @if(session('delete'))
                  <div class="alert alert-success">{{ session('delete') }}</div>
                @endif
                <table class="table table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($users as $sl=>$user)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                             @if($user->photo ==null)
                             <img src="https://via.placeholder.com/30x30" alt="profile">
                             @else
                             <img src="{{ asset('uploads/user') }}/{{ $user->photo }}" alt="">
                             @endif
                        </td>
                        <td><a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger" style="border-radius: 45%"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-header bg-primary">
            <h3 class="text-white">Add New Users</h3>
        </div>
        <div class="card-body">
            @if(session('add_user'))
                <div class="alert alert-success">{{ session('add_user') }}</div>
            @endif
            <form action="{{ route('add.user') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                     <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection
