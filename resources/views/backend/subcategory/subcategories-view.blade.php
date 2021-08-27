@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Subccategory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Subccategory</li>
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
                <h3 class="card-title">All Subccategory </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('delete-all-subcategories') }}" method="post">
                  @csrf
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        @can('delete subcategory')
                            <th width="4%"></th>
                        @endcan
                        <th width="3%">#</th>
                        <th>Subcategory Name</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        @if (auth()->user()->can('edit subcategory')||auth()->user()->can('delete subcategory'))
                            <th class="text-center">Action</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($subCatView as $key=> $item)
                            <tr>
                                @can('delete subcategory')
                                    <td><input type="checkbox" name="delete[]" value="{{ $item->id }}" ></td>
                                @endcan
                                <td>{{ $subCatView->firstItem() + $key }}</td>
                                <td>{{ $item->subcategory_name }}</td>
                                <td>{{ $item->category->category_name}}</td>
                                <td>{{ $item->subcategory_slug }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                @if (auth()->user()->can('edit subcategory')||auth()->user()->can('delete subcategory'))
                                    <td class="text-center">
                                        @can('edit subcategory')
                                            <a class="btn btn-primary" href="{{ url('edit-subcategory').'/'.$item->id }}"><i class="fas fa-edit text-white"></i> Edit</a>
                                        @endcan
                                        @can('delete subcategory')
                                            <a class="btn btn-danger" href="{{ url('delete-subcategory')}}/{{ $item->id }}"><i class="fas fa-trash text-white"></i> Delete</a>
                                        @endcan
                                    </td>
                                @endif
                            </tr>
                          @empty
                          <td class="text-center text-muted" colspan="10">No data available</td>
                        @endforelse
                    </tbody>
                  </table>
                  @can('delete subcategory')
                    @if ($subCatCount != 0)
                        <img src="{{ asset('assets/dist/img/arrow_ltr.png') }}" alt="">
                        <input type="checkbox" id="checkAll" > <label for="checkAll" class="checkLbl">Check All</label>
                        <button type="submit" class="btn deleteAll font-weight-bold "> <i class="fas fa-minus-circle text-danger  "></i> Delete</button>
                    @endif
                  @endcan

                </form>
              </div>
              <!-- /.card-body -->

              <div class="card-footer clearfix">
                {{ $subCatView->links()}}
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
@section('subcategoryOpened')
menu-is-opening menu-open
@endsection
@section('subcategoryActive')
    active
@endsection
@section('viewSubcategoryActive')
    active
@endsection
@section('subcategoryDBlock')
    display:block;
@endsection
