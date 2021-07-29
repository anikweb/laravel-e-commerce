@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Trash Subcategory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Trash Subcategory</li>
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
                <h3 class="card-title">Trash Subcategory {{ session('pDeleteSecurity') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('delete-all-subcategories-trash') }}" method='post'>
                  @csrf
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="4%"></th>
                        <th style="width: 3%">#</th>
                        <th>Subcategory Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($subcatTrash as $key=> $subcatViewLoop)
                        <tr>
                          <td><input type="checkbox" name="delete[]" value="{{ $subcatViewLoop->id }}"></td>
                          <td>{{ $subcatTrash->firstItem() + $key }}</td>
                          <td>{{ $subcatViewLoop->subcategory_name }}</td>
                          <td>{{ $subcatViewLoop->subcategory_slug }}</td>
                          <td>{{ $subcatViewLoop->created_at->format('h:i A,  d-M-Y')}}({{ $subcatViewLoop->created_at->diffForHumans() }})</td>
                          <td class="text-center">
                            <a class="btn btn-success" href="{{ url('restore-subcategory').'/'.$subcatViewLoop->id }}"><i class="fas fa-undo text-white"></i> Restore</a>
                            @if (session('pDeleteSecurity')!='true')
                              <button type="button" class="btn btn-danger DeletePermanent" data-id='{{ $subcatViewLoop->id }}' data-toggle="modal" data-target="#ModalCenter"><i class="fas fa-trash text-white"></i> Permanent Delete</button>
                            @else
                              <button type="button" class="btn btn-danger DeletePermanentWithSecurity" {{-- href="{{ url('permanent-delete-category') }}/{{ $catViewLoop->id }}" --}} data-id='{{ $subcatViewLoop->id }}'>Permanent Delete</button>
                            @endif
                          </td>
                        </tr>
                      @empty
                        <td class="text-center text-muted" colspan="10">No data Available</td>
                      @endforelse
                    </tbody>
                  </table>
                  @if ($subcatTrashCount !=0)
                    <img class="ml-2" src="{{ asset('assets/dist/img/arrow_ltr.png') }}" alt="">
                    <input type="checkbox"  id="checkAll"> <label for="checkAll" class="checkLbl">Check All</label>
                    <button type="submit" class="btn deleteAll font-weight-bold "> <i class="fas fa-minus-circle text-danger  "></i> Permanent Delete</button>
                    <button  class="btn font-weight-bold allDelete" type="button"><i class="fas fa-undo-alt text-success"></i> Restore</button>
                  @endif
                </form>
              </div>
              <!-- /.card-body -->

              <div class="card-footer clearfix">
                {{ $subcatTrash->links()}}
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
  <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{ url('permanent-delete-subcategory-security') }}" method="post">
          @csrf
          <div class="modal-header">
          <h3 class="text-center">Are You Sure?</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="subcat_id" class="subcat_id">
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
    .deleteAll:hover,.checkLbl:hover{
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
     var subcat_id = $(this).attr('data-id');
     $('.subcat_id').val(subcat_id);
    });


    $('.DeletePermanentWithSecurity').click(function(){
      var subcat_id = $(this).attr('data-id');
      swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this Subcategory",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = "/permanent-delete-subcategory"+'/'+subcat_id;
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
@section('subcategoryOpened')
menu-is-opening menu-open
@endsection
@section('subcategoryActive')
    active
@endsection
@section('trashSubcategoryActive')
    active
@endsection
@section('subcategoryDBlock')
    display:block;
@endsection
