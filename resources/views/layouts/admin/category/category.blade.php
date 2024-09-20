@extends('layouts.admin')
@section('content')
 <div class="row">
   <div class="col-lg-8">
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="text-white">Category List</h3>
        </div>
         <div class="card-body">
            @if(session('cat_update'))
            <div class="alert alert-success">{{ session('cat_update') }}</div>
            @endif
            @if(session('cat_delete'))
            <div class="alert alert-success">{{ session('cat_delete') }}</div>
            @endif
            <form action="{{ route('check.delete') }}" method="post">
                @csrf
               <table class="table table-striped" >
               <tr>
                <th width="50">
                    <div class="form-check">
                       <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"  id="chkSelectAll">
                          Check All
                        <i class="input-frame"></i>
                       </label>
                    </div>
                  </th>
                <th>Sl</th>
                <th>Category Name</th>
                <th>Category Image</th>
                <th>Action</th>
               </tr>
               @forelse ($categories as $sl=>$category)
               <tr>
                <td>
                    <div class="form-check">
                      <label class="form-check-label">
                       <input type="checkbox" name='category_id[]' value="{{ $category->id }}" class="form-check-inpu chkDel">
                       <i class="input-frame"></i>
                      </label>
                   </div>
                  </td>
                <td>{{ $sl+1 }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                    <img src="{{ asset('uploads/category')}}/{{ $category->category_image }}" alt="" width="100">
                </td>
                    <td><a href="{{ route('category.edit',$category->id) }}"class="btn btn-success" style="border-radius: 45%"><i class="fa fa-pencil"></i></a>
                     <a href=" {{ route('category.delete',$category->id) }}" class="btn btn-danger" style="border-radius: 45%"><i class="fa fa-trash"></i></a>
                    </td>
               </tr>
               @empty
               <tr>
                <td  class="text-center" colspan="5"><h2>No Data Available</h2></td>
               </tr>
               @endforelse
               </table>
                <div class="my-2">
                   <button type="submit" class="btn btn-danger del_check d-none">Delete Check</button>
                </div>
            </form>
         </div>
    </div>
   </div>
   <div class="col-lg-4">
      <div class="card">
         <div class="card-header bg-primary">
            <h3 class="text-white">Add Category</h3>
         </div>
         <div class="card-body">
            @if(session('category_add'))
            <div class="alert alert-success">{{ session('category_add') }}</div>
            @endif
            <form action="{{ route('category.add') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="mb-3">
                  <label class="form-label">Category Name</label>
                  <input type="text" name="category_name" class="form-control">
                  @error('category_name')
                    <strong class="text-danger">{{ $message }}</strong>
                  @enderror
               </div>
               <div class="mb-3">
                <label class="form-label">Category Image</label>
                <input type="file" name="category_image" class="form-control"   onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                @error('category_image')
                <strong class="text-danger">{{ $message }}</strong>
               @enderror
               <div class="my-2">
                <img src="" id="blah" alt="" width='100'>
              </div>
             </div>
             <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add Category</button>
             </div>
            </form>
        </div>
      </div>
   </div>
</div>
@endsection


@section('script')
 <script>
    $("#chkSelectAll").on('click', function(){
    this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
    $('.del_check').toggleClass('d-none');
})
$(".chkDel").on('click', function(){
    $('.del_check').removeClass('d-none');
})
 </script>

@endsection
