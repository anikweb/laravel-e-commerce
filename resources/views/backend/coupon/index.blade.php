@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Coupon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Coupon</li>
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
                    <h3 class="card-title">All Coupon </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="#" method="post">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="4%"></th>
                                    <th style="width: 3%">#</th>
                                    <th>Coupon Name</th>
                                    <th>Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupon as $couponItem)
                                    <tr>
                                        <td><input type="checkbox" name="delete[]" value="{{ $couponItem->id }}"></td>
                                        <td>{{ $coupon->firstItem() + $loop->index }}</td>
                                        <td>{{ $couponItem->coupon_name }}</td>
                                        <td>{{ $couponItem->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-success" href="{{ route('coupon.show',$couponItem->id) }}"> <i class="fas fa-eye text-white"></i> Details</a>
                                            <a class="btn btn-info" href="{{ route('coupon.edit',$couponItem->id) }}"> <i class="fas fa-edit text-white"></i> Edit</a>
                                            <a class="btn btn-danger" href="{{ route('coupon.destroy',$couponItem->id) }}"><i class="fas fa-trash text-white"></i> Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <td class="text-center text-muted" colspan="10">No data available</td>
                                @endforelse
                            </tbody>
                        </table>
                    @if ($coupon->count() >0)
                        <img class="ml-2" src="{{ asset('assets/dist/img/arrow_ltr.png') }}" alt="">
                        <input type="checkbox" id="checkAll"> <label for='checkAll' class="checkLbl">Check All</label>
                        <button button  class="btn font-weight-bold deleteAll" type="submit"><i class="fas fa-minus-circle text-danger"></i> Delete</button>

                    @endif
                    {{-- </form> --}}
                </div>
                <!-- /.card-body -->

              <div class="card-footer clearfix">
                {{ $coupon->links() }}
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
{{--  @section('internal_style')
    <style>
      .checkLbl{
        cursor: pointer;
      }
      .deleteAll:hover,.checkLbl:hover{
        text-decoration:underline;
      }
    </style>
@endsection  --}}
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
