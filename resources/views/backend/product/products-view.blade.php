@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Products</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('delete-all-categories') }}" method="post">
                  @csrf
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        @can('stock out product')
                            <th width="2%"></th>
                        @endcan
                        <th style="width: 3%">#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Sub-Category</th>
                        <th>Summary</th>
                        <th>Color</th>
                        <th>Description</th>
                        <th>Thumbnail</th>
                        <th>Created At</th>
                        @if (auth()->user()->can('edit product')||auth()->user()->can('stock out product'))
                            <th width="15%" class="text-center">Action</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($prodView as $key=> $prodViewLoop)
                            <tr>
                            @can('stock out product')
                                <td><input type="checkbox" name="delete[]" value="{{ $prodViewLoop->id }}"></td>
                            @endcan
                            <td>{{ $prodView->firstItem() + $key }}</td>
                            <td>{{ $prodViewLoop->title }}</td>
                            <td>{{ $prodViewLoop->category->category_name }}</td>
                            <td>{{ $prodViewLoop->subcategory->subcategory_name }}</td>
                            <td>{{ $prodViewLoop->summary }}</td>
                            <td>
                                <ul class="p-1 pl-3">
                                    @php
                                        $data = $prodViewLoop->attribute->unique('color_id');
                                    @endphp
                                        @foreach ($data as $attribute)
                                            <li>{{ $attribute->color->color_name }}</li>
                                        @endforeach
                                </ul>
                            </td>
                            <td>{{ $prodViewLoop->description }}</td>
                            <td>
                                <img width="100" src="{{ asset('products/thumbnails/'.$prodViewLoop->created_at->format('Y/m/').$prodViewLoop->id.'/'.$prodViewLoop->thumbnail) }}" alt="{{ $prodViewLoop->title }}">
                            </td>
                            <td>{{ $prodViewLoop->created_at->diffForHumans() }}</td>
                            @if (auth()->user()->can('edit product')||auth()->user()->can('stock out product'))
                                <td class="text-center">
                                    @can('edit product')
                                        <a class="btn btn-primary" href="{{ route('editProduct',$prodViewLoop->slug) }}"> <i class="fas fa-edit text-white"></i> Edit </a>
                                    @endcan
                                    @can('stock out product')
                                        <a class="btn btn-danger" href="{{ url('delete-category') }}/{{ $prodViewLoop->id }}"><img width="20" src="{{ asset('assets/dist/img/stock-out.png') }}" alt="stock out"> Stock Out</a>
                                    @endcan
                                </td>
                            @endif
                            </tr>
                        @empty
                            <td class="text-center text-muted" colspan="10">No data available</td>
                        @endforelse
                    </tbody>
                  </table>
                    @can('stock out product')
                        @if ($catViewCount !=0)
                            <img class="ml-2" src="{{ asset('assets/dist/img/arrow_ltr.png') }}" alt="">
                            <input type="checkbox" id="checkAll"> <label for='checkAll' class="checkLbl">Check All</label>
                            <button button  class="btn font-weight-bold deleteAll" type="submit"><i class="fas fa-minus-circle text-danger"></i> Stock Out</button>
                        @endif
                    @endcan
                </form>
              </div>
              <!-- /.card-body -->

              <div class="card-footer clearfix">
                {{ $prodView->links()}}
                {{--  <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>  --}}
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
    $('#checkAll').click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
  </script>
@endsection
@section('productOpen')
  menu-is-opening menu-open
@endsection
@section('productActive')
  active
@endsection
@section('viewProductActive')
  active
@endsection
@section('productDBlock')
    display:block;
@endsection
