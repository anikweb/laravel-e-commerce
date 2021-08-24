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
                    {{-- <form action="#" method="post"> --}}
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 3%">#</th>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th>Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as  $role)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <ol>

                                                @foreach ($role->permissions as $permission)
                                                <li>{{ $permission->name }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>{{ $role->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-success" href="#"> <i class="fas fa-eye text-white"></i> Details</a>
                                            <a class="btn btn-info" href="#"> <i class="fas fa-edit text-white"></i> Edit</a>
                                            {{-- <form action="#" method="POST" style="display: inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash text-white "></i>
                                                    <span> Delete</span>
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <td class="text-center text-muted" colspan="10">No data available</td>
                                @endforelse
                            </tbody>
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
    @elseif(session('fail'))
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
    // $('.delete-coupon').click(function(){
    //     swal({
    //         title: "Are you sure?",
    //     // text: "Once deleted, you will not be able to recover this Category",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //     .then((willDelete) => {
    //         if (willDelete) {
    //             swal("Succeess! Your category has been permanently deleted!", {
    //                 icon: "success",
    //             });
    //             setTimeout(function(){
    //                 $('.coupon-delete').submit();
    //             }, 1000);


    //             // // window.location.href = "/permanent-delete-category"+'/'+cat_id;

    //         } else {
    //             swal("Your category still now in trash!");
    //         }
    //     });
    // });
    $('#checkAll').click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
  </script>

@endsection
