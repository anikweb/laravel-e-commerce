@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
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
                <h3 class="card-title ">Edit Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ url('update-category') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="category_id" value="{{ $catView->id }}">
                            <label for="category">Category Name</label>
                            <input name="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" id="category" placeholder="Enter Category" value="{{ $catView->category_name }}">
                            @error('category_name')
                              <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                         </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="category_slug">Slug</label>
                            <input name="category_slug" type="text" class="form-control @error('category_slug') is-invalid @enderror" id="category_slug" placeholder="Enter Category" value="{{ $catView->category_slug }}">
                            @error('category_slug')
                              <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                          </div>
                      </div>
                    </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-edit text-white"></i> Update</button>
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
@section('footer_js')
  <script>
    $('#category').keyup(function() {
      $('#category_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
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