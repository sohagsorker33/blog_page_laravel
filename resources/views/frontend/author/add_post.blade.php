@extends('frontend.author.author_admin_panel')

@section('content')
 <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Add New Post</h3>
            </div>
            <div class="card-body">
                @if(session('post_add'))
                <div class="alert alert-success">{{ session('post_add') }}</div>
                @endif
                <form action="{{ route('post.insert') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for=" "><h5>Category</h5></label>
                            <select name="category_id" class="form-control">
                               <option value="">Select Category</option>
                                @foreach ($categories as $category )
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="mb-3">
                            <label for=" "><h5>Read_time</h5></label>
                            <input type="number" name="read_time" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="mb-3">
                            <label for=" "><h5>Title</h5></label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for=""><h5>Description</h5></label>
                             <textarea name="description" id="summernote"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for=" "><h5>Tags</h5></label>
                            <select name="tag_id[]" id="select-gear" class="demo-default" multiple placeholder="Select gear...">
                                <option value="">Select tags...</option>
                                <optgroup label="Climbing">
                                    @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for=""><h5>Slug</h5></label>
                            <input type="text" name="slug" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for=""class="form-label"><h5>Preview Image</h5></label>
                            <input type="file" name="preview" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for=""class="form-label"><h5>Thumbnail Image</h5></label>
                            <input type="file" name="thumbnail" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 m-auto">
                        <div class="mb-3 mt-5">
                            <button type="submit" class="btn btn-primary form-control"><h5>Add Post</h5></button>
                        </div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection

@section('script')
<script>
     $('#summernote').summernote();
     $('#select-gear').selectize({ sortField: 'text' })
</script>

@endsection
