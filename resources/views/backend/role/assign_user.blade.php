@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assign Role</li>
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
          <div class="col-md-12 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title ">Assign Role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('assign.user.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user">Select User</label>
                                <select name="user" id="user" class="form-control">
                                    <option>-Select-</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                @error('user')
                                  <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                             </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Select Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option>-Select-</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                  <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                             </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i> Assign</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">User and Permissions</div>
                </div>
                <div class="card-body">
                    <table class="table  table-bordered">
                        <div class="table-responsive">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @forelse ($user->roles as $role)
                                               <p class="text-bold"> {{ $role->name }}</p>

                                            @empty
                                                No Role Assign Yet
                                            @endforelse
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </div>
                    </table>
                </div>
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

