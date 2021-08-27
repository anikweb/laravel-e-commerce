@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Role</li>
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
                <h3 class="card-title ">Add Role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('role.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Role Name</label>
                                <input name="role_name" type="text" class="form-control @error('role_name') is-invalid @enderror" id="role" placeholder="Enter Role Name" value="{{ old('role_name') }}">
                                @error('role_name')
                                  <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                             </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Choose Permisions</label>

                                    @foreach ($permissions as $permission)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox{{ $permission->id }}" value="{{ $permission->name }}" name="permission[]"><label for="customCheckbox{{ $permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
                                    </div>
                                        @endforeach


                                @error('role_name')
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

