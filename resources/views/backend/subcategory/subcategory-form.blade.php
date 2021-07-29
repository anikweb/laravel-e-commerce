@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Subcategory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Subcategory</li>
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
                <h3 class="card-title ">Add Subcategory</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ url('post-subcategory') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="subcategory">Subcategory Name</label>
                            <input name="subcategory_name" type="text" class="form-control @error('subcategory_name') is-invalid @enderror" id="subcategory" placeholder="Enter Category" value="{{ old('subcategory_name') }}">
                            @error('subcategory_name')
                              <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="subcategory_slug">Slug</label>
                            <input name="subcategory_slug" type="text" class="form-control @error('subcategory_slug') is-invalid @enderror" id="subcategory_slug" placeholder="Enter Category" value="{{ old('subcategory_slug') }}">
                            @error('subcategory_slug')
                              <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                          </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="parent_category">Parent Category</label>
                          <select name="parent_category" id="parent_category" class="form-control @error('parent_category') is-invalid @enderror">
                            <option value="" >Select One</option>
                            @forelse ($catView as $item)
                              <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @empty
                              <option disabled class="text-danger" value="">You have not created any categories yet</option>
                            @endforelse
                          </select>
                            @error('parent_category')
                              <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square text-white"></i> Submit</button>
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
    $('#subcategory').keyup(function() {
      $('#subcategory_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
  </script>
@endsection
@section('subcategoryOpened')
menu-is-opening menu-open
@endsection
@section('subcategoryActive')
    active
@endsection
@section('addSubcategoryActive')
    active
@endsection
@section('subcategoryDBlock')
    display:block;
@endsection