@extends('backend.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Trash Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Trash Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Trash Category</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('delete-all-categories-trash') }}" method="post">
                @csrf
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width='2%'></th>
                        <th style="width: 3%">#</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($catView as $key=> $catViewLoop)
                          <tr>
                              <td><input type="checkbox" name="delete[]" value="{{ $catViewLoop->id }}"></td>
                              <td>{{ $catView->firstItem() + $key }}</td>
                              <td>{{ $catViewLoop->category_name }}</td>
                              <td>{{ $catViewLoop->category_slug }}</td>
                              <td>{{ $catViewLoop->created_at->format('h:i A,  d-M-Y')}}({{ $catViewLoop->created_at->diffForHumans() }})</td>
                              <td class="text-center">
                                  <a class="btn btn-success" href="{{ url('restore-category').'/'.$catViewLoop->id }}"><i class="fas fa-undo text-success text-white"></i> Restore</a>
                                  @if (session('pDeleteSecurity')!='true')
                                    <button type="button" class="btn btn-danger DeletePermanent" data-id='{{ $catViewLoop->id }}' data-toggle="modal"data-target="#exampleModalCenter"><i class="fas fa-trash text-white"></i> Permanent Delete</button>
                                  @else
                                    <button type="button" class="btn btn-danger DeletePermanentWithSecurity" data-id='{{ $catViewLoop->id }}'>Permanent Delete</button>
                                  @endif
                              </td>
                          </tr>
                        @empty
                          <td class="text-center text-muted
                          " colspan="10">No data Available</td>
                      @endforelse
                    </tbody>
                  </table>
                  @if ($catViewCount !=0)
                    <img class="ml-2" src="{{ asset('assets/dist/img/arrow_ltr.png') }}" alt="">
                    <input type="checkbox" id='checkAll'> <label for='checkAll' class="checkLbl">Check All</label>
                    <button type="submit" class="btn allDelete font-weight-bold"> <i class="fas fa-minus-circle text-danger"></i> Permanent Delete</button>
                    <button  class="btn font-weight-bold allDelete" type="button"><i class="fas fa-undo-alt text-success"></i> Restore</button>
                  @endif
                </form>
              </div>
              <!-- /.card-body -->
             
              <div class="card-footer clearfix">
                {{ $catView->links()}}
                {{-- <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul> --}}
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  {{-- security confirmation modal  --}}
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{ url('permanent-delete-category-security') }}" method="post">
          @csrf
          <div class="modal-header">
          <h3 class="text-center">Are You Sure?</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="cat_id" class="cat_id">
            <input type="password" name="password" class="form-control" placeholder="Type your password for security">

         
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('internal_style')
    <style>
      .checkLbl{
        cursor: pointer;
      }
      .allDelete:hover,.checkLbl:hover{
        text-decoration:underline;
      }
    </style>
@endsection
@section('footer_js')
  <script>
    @if(session('success'))
      toastr["success"]("{{ session('success') }}")
    $(this).attr("data-id");
    toastr.options = {
    
      "positionClass": "toast-top-right",
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  @endif
  @if(session('fail'))
      toastr["error"]("{{ session('fail') }}")
    $(this).attr("data-id");
    toastr.options = {
    
      "positionClass": "toast-top-right",
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  @endif

    $('.DeletePermanent').click(function(){
     var cat_id = $(this).attr('data-id');
     $('.cat_id').val(cat_id);
    });

    
    $('.DeletePermanentWithSecurity').click(function(){
      var cat_id = $(this).attr('data-id');
      swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this Category",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = "/permanent-delete-category"+'/'+cat_id;
          // swal("Succeess! Your category has been permanently deleted!", {
          //   icon: "success",
          // });
        } else {
          swal("Your category still now in trash!");
        }
      });
    });
    $('#checkAll').click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
  </script>
@endsection
@section('categoryOpen')
  menu-is-opening menu-open
@endsection
@section('categoryActive')
  active
@endsection
@section('trashCategoryActive')
  active
@endsection
@section('categoryDBlock')
    display:block;
@endsection
