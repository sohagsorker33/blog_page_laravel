@extends('layouts.admin')

@section('content')
 <div class="row">
    <div class="col-lg-10">
      <div class="card">
        <div class="card-header bg-primary">
            <h3 class="text-white">Authors List</h3>
        </div>
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if(session('delete'))
        <div class="alert alert-success">{{ session('delete') }}</div>
    @endif
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($authors as $sl=>$author)
                   <tr>
                      <td>{{ $sl+1 }}</td>
                      <td>{{ $author->name }}</td>
                      <td>  {{ $author->email }}</td>
                      <td>
                        @if($author->photo ==null)
                         <img src="https://via.placeholder.com/30x30" alt="">
                        @else
                          pic nai
                        @endif
                      </td>
                     <td>{{ $author->status==1?'Active':'Deactive' }}</td>
                     <td>
                         <a href="{{ route('author.status',$author->id) }}" class="btn btn-{{ $author->status==1?'success':'danger' }}" style="width:100px">{{ $author->status==1?'Active':'Deactive' }}</a>
                         <a href="{{ route('author.delete',$author->id) }}" class="btn btn-danger del" style="border-radius: 45%"><i class="fa fa-trash"></i></a>
                     </td>
                  </tr>
                @endforeach
            </table>
        </div>
      </div>
    </div>
 </div>
@endsection
