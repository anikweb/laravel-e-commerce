@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Coupon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Coupon</li>
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
                    <h3 class="card-title">{{ $coupon->coupon_name }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="#" method="post">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Coupon Name</th>
                                    <td>{{ $coupon->coupon_name }}</td>
                                </tr>
                                <tr>
                                    <th>Discount Range(%)</th>
                                    <td>{{ $coupon->discount_range }}</td>
                                </tr>
                                <tr>
                                    <th>Limit</th>
                                    <td>{{ $coupon->limit }}</td>
                                </tr>
                                <tr>
                                    <th>Expiry Date</th>
                                    <td>{{ $coupon->expiry_date }}</td>
                                </tr>
                                <tr>
                                    <th>Expiry Time</th>
                                    <td>{{ $coupon->expiry_time }}</td>
                                </tr>
                                <tr>
                                    <th>Last Update</th>
                                    <td>{{ $coupon->updated_at->diffForHumans() }}</td>
                                </tr>
                            </thead>
                        </table>
                    {{-- </form> --}}
                </div>
                <!-- /.card-body -->
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
  </script>
@endsection
