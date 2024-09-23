@extends('frontend.author.author_admin_panel')

@section('content')
  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>My Post List</h3>
            </div>
            <div class="card-body">
                 @if(session('post_delete'))
                    <div class="alert alert-success">{{ session('post_delete') }}</div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>Title</th>
                        <th>Preview Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ( $posts as $index=>$post )
                        <tr>
                            <td>{{ $posts->firstitem()+$index}}</td>
                            <td>{{ $post->title }}</td>
                            <td><img src="{{ asset('uploads/post/preview') }}/{{ $post->preview }}" alt="" width="100"></td>
                            <td><a href="{{ route('my.post.status',$post->id) }}" class="badge badge-{{ $post->status==1?'success':'secondary' }} ">{{ $post->status==1?'Active':'Deactive' }}</a></td>
                            <td><a href="{{ route('post.delete',$post->id) }}" class="btn btn-danger del" style="border-radius: 45%"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                </table>
                <div class="my-2">
                   {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
