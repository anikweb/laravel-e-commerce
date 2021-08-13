@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Coupon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Coupon</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-11 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title ">Edit Coupon</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('coupon.update',$coupon->id) }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coupon">Coupon Name</label>
                                <input type="text" name="coupon_name" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon" value="@if(old('coupon_name')){{old('coupon_name')}}@else{{$coupon->coupon_name}}@endif">
                                @error('coupon_name')
                                  <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                             </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount">Discount Range <em>(1% - 99%)</em></label>
                                <input name="discount_range" type="number" class="form-control @error('discount_range') is-invalid @enderror" id="discount" value="@if(old('discount_range')){{old('discount_range')}}@else{{$coupon->discount_range}}@endif">
                                @error('discount_range')
                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="limit" title="How many time wii be use this coupon.">Limit <em class="text-muted">(optional)</em></label>
                                <input name="limit" type="number" class="form-control @error('limit') is-invalid @enderror" id="limit" value="@if(old('limit')){{old('limit')}}@else{{$coupon->limit}}@endif">
                                @error('limit')
                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expiry">Expiry Date</label>
                                <input name="expiry_date" type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry" value="@if(old('expiry_date')){{old('expiry_date')}}@else{{$coupon->expiry_date}}@endif">
                                @error('expiry_date')
                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time">Expiry Time <em class="text-muted">(optional)</em></label>
                                <input name="expiry_time" type="time" class="form-control @error('expiry_time') is-invalid @enderror" id="time" value="@if(old('expiry_time')){{old('expiry_time')}}@else{{$coupon->expiry_time}}@endif">
                                @error('expiry_time')
                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i> Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

