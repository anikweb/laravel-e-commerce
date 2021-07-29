@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Categories</li>
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
                <h3 class="card-title">All Categories </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('delete-all-categories') }}" method="post">
                  @csrf
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="4%"></th>
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
                              <a class="btn btn-primary" href="{{ route('editCategory',$catViewLoop->id) }}"> <i class="fas fa-edit text-white"></i> Edit</a>
                              <a class="btn btn-danger" href="{{ route('DeleteCategory',$catViewLoop->id) }}"><i class="fas fa-trash text-white"></i> Delete</a>
                          </td>
                        </tr>
                      @empty
                        <td class="text-center text-muted" colspan="10">No data available</td>
                      @endforelse
                    </tbody>
                  </table>
                  @if ($catViewCount !=0)
                    <img class="ml-2" src="{{ asset('assets/dist/img/arrow_ltr.png') }}" alt="">
                    <input type="checkbox" id="checkAll"> <label for='checkAll' class="checkLbl">Check All</label>
                    <button button  class="btn font-weight-bold deleteAll" type="submit"><i class="fas fa-minus-circle text-danger"></i> Delete</button>

                  @endif
                {{-- </form> --}}
              </div>
              <!-- /.card-body -->

              <div class="card-footer clearfix">
                {{ $catView->links() }}
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
@section('viewCategoryActive')
  active
@endsection
@section('categoryDBlock')
    display:block;
@endsection
