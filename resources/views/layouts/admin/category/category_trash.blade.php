@extends('layouts.admin');

@section('content')

<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Trash Category List</h3>
            </div>
             <div class="card-body">
                @if(session('cat_restore'))
                <div class="alert alert-success">{{ session('cat_restore') }}</div>
                @endif
                @if(session('cat_delete'))
                <div class="alert alert-success">{{ session('cat_delete') }}</div>
                @endif
                <form action="{{ route('restore.delete.check') }}" method="post">
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
                   @foreach ( $Category_trash as $sl=>$category)
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
                        <td><a href="{{ route('category.restore',$category->id) }}"class="btn btn-success" style="border-radius: 45%"><i class="fa fa-trash-can-arrow-up"></i></a>
                         <a data-link=" {{ route('category.hard.delete',$category->id) }}" class="btn btn-danger del" style="border-radius: 45%"><i class="fa fa-trash"></i></a>
                        </td>
                   </tr>
                   @endforeach
                </table>
                <div class="my-2">
                    <button type="submit" name="action_btn" value="1" class="btn btn-info del_check d-none">Restore Check</button>
                    <button type="submit" name='action_btn' value="2" class="btn btn-danger del_check d-none">Delete Check</button>
                 </div>
                </form>
             </div>
        </div>
       </div>
</div>
@endsection


@section('script')
  <script>
   $('.del').click(function(){
       Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
       }).then((result) => {
        if (result.isConfirmed) {
            var link = $(this).data('link');
            window.location.href = link;
        }
       });
   })
  </script>
  @if(session('cat_hard_delete'))
    <script>
    Swal.fire({
      title: "Deleted!",
      text: "{{ session('cat_hard_delete') }}",
      icon: "success"
    });
    </script>
  @endif
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





