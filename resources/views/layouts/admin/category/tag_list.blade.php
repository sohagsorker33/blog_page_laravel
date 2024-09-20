@extends('layouts.admin');
 @section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Tag List Show</h3>
                </div>
                <div class="card-body">
                    @if(session('tag_delete'))
                        <div class="alert alert-success">{{ session('tag_delete') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Tag Name</th>
                            <th>Action</th>

                        </tr>
                        @foreach ($tags as $sl=>$tag)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $tag->tag_name }}</td>
                            <td><a href="{{ route('tag.list.delete',$tag->id) }}" class="btn btn-danger" style="border-radius: 45%"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Tag List Added</h3>
                </div>
                <div class="card-body">
                    @if(session('tag_add'))
                        <div class="alert alert-success">{{ session('tag_add') }}</div>
                    @endif()
                    <form action="{{ route('tags.add') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tag Name</label>
                            <input type="text" name="tag_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 @endsection
