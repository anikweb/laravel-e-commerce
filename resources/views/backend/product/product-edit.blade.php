@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
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
                <h3 class="card-title ">Edit Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('updatePostProduct') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        {{-- product title start --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="product_title">Title</label>
                                <input type="hidden" name="product_id" value="{{ $productView->id }}">
                                <input name="product_title" type="text" class="form-control @error('product_title') is-invalid @enderror" id="product_title" placeholder="Enter Product Title" value="{{ $productView->title }}">
                                @error('product_title')
                                    <div class="text-danger fa fa py-2 pl-2">
                                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- product title end --}}
                        {{-- thumbnail image file input start --}}
                        <div class="col-md-10 my-auto mt-2">
                            <div class="form-group">
                                <label for="product_thumbnail">Thumbnail</label>
                                <input name="product_thumbnail" type="file" class="form-control @error('product_thumbnail') is-invalid @enderror" id="product_thumbnail" onchange="document.getElementById('ThumbnailPreview').src = window.URL.createObjectURL(this.files[0])">
                                @error('product_thumbnail')
                                    <div class="text-danger fa fa py-2 pl-2">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- thumbnail image file input end --}}
                        {{-- thumbnail image preview start --}}
                        <div class="col-md-2 mt-2">
                            <img width="100%" src="{{ asset('products/thumbnails/'.$productView->created_at->format('Y/m/').$productView->id.'/'.$productView->thumbnail) }}" draggable="false"  id="ThumbnailPreview" alt="{{ $productView->title }}">
                        </div>
                        {{-- thumbnail image preview end --}}
                        <div class="col-md-12 mt-2">
                            <label>Multiple Images <i class="fas fa-arrow-down"></i></label>
                        </div>
                        {{-- image gallery loop start  --}}
                        @foreach ($productView->imageGallery as $key=> $mulImage)
                            {{-- image gallery input file start  --}}
                            <div class="col-md-6 my-auto mt-2">
                                <div class="form-group">
                                    <label for="multiple_image">Image-{{ ++$key }} Change</label>
                                    <input type="hidden" name="mulImgId[]" value="{{ $mulImage->id }}">
                                    <input name="multiple_image[]" type="file" class="form-control" id="multiple_image{{ $mulImage->id }}" onchange="document.getElementById('multiple_imagePre{{ $mulImage->id }}').src = window.URL.createObjectURL(this.files[0])">
                                    @error('multiple_image')
                                        <div class="text-danger fa fa py-2 pl-2">
                                            <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- image gallery input file end  --}}
                            {{-- image gallery preview start  --}}
                            <div class="col-md-2 mt-2">
                                <img width="100%" src="{{ asset('products/image-gallery/'.$productView->created_at->format('Y/m/').$productView->id.'/'.$mulImage->image_name) }}" draggable="false"  id="multiple_imagePre{{ $mulImage->id }}" alt="{{ $productView->title }}">
                            </div>
                            {{-- image gallery preview end  --}}
                        @endforeach
                        {{-- image gallery loop end  --}}
                        {{-- add new image to gallery input file start  --}}
                        <div class="col-md-6 my-auto mt-2">
                            <div class="form-group">
                                <label for="multiple_image_new">Add Image to Gallery</label>
                                <input name="multiple_image_new[]" type="file" class="form-control" id="multiple_image_new" multiple>
                                {{-- @error('multiple_image[]')
                                    <div class="text-danger fa fa py-2 pl-2">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror --}}
                            </div>
                        </div>
                        {{-- add new image to gallery input file end  --}}
                        {{-- category start  --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="" class="text-muted">Select One</option>
                                    @forelse ($catView as $catViewItem)
                                        <option @if($productView->Category_id == $catViewItem->id ) selected @endif value="{{ $catViewItem->id }}">{{ $catViewItem->category_name }}</option>
                                    @empty
                                        <option value="" class="text-danger" disabled>Empty</option>
                                    @endforelse
                                </select>
                                @error('category_id')
                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- category end  --}}
                        {{-- subcategory start  --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subCategory_id">Sub-Category</label>
                                <select name="subCategory_id" id="subCategory" class="form-control @error('subCategory_id') is-invalid @enderror">
                                    @foreach($scatView as $scatViewLoop)
                                        <option @if($productView->subategory_id == $scatViewLoop->id ) selected @endif value="{{ $scatViewLoop->id }}">{{ $scatViewLoop->subcategory_name }}</option>
                                    @endforeach
                                </select>
                                @error('subCategory_ids')
                                    <div class="text-danger fa fa py-2 pl-2">
                                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- subcategory end  --}}
                        {{-- summary start  --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="summary">Summary</label>
                                <textarea name="summary" id="summary" value="{{ old('summary') }}" class="form-control @error('summary') is-invalid @enderror">{{ $productView->summary }}</textarea>
                                @error('summary')
                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- summary end  --}}
                        {{-- description start  --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" value="{{ old('description') }}" rows="4" class="form-control @error('description') is-invalid @enderror">{{ $productView->description }}</textarea>
                                @error('description')
                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- description end  --}}
                        {{-- attribute start  --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="multi-field-wrapper">
                                    <div class="multi-fields">
                                        <div class="row multi-field form-group my-2">
                                            <div class="col-md-12">
                                                {{-- attribute loop start  --}}
                                                @foreach ($productView->attribute as $product)
                                                    <div class="row multi-field-r-item">
                                                        <input type="hidden" name="attrId[]" value="{{ $product->id }}">
                                                        {{-- color start  --}}
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="color">Color</label>
                                                                <select name="color[]" class="form-control" id="color">
                                                                    <option value class="text-muted">--Select One--</option>
                                                                    {{-- color upload start in database  --}}
                                                                    @forelse ($colrView as $colrViews)
                                                                        <option @if($product->color_id == $colrViews->id) selected @endif value="{{ $colrViews->id }}">{{  $colrViews->color_name }}</option>
                                                                    @empty
                                                                        <option value class="text-danger">empty</option>
                                                                    @endforelse
                                                                    {{-- color upload end --}}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{-- color end  --}}
                                                        {{-- size start  --}}
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="size">Size</label>
                                                                <select name="size[]" class="form-control" id="size">
                                                                    <option value class="text-muted">--Select One--</option>
                                                                    @forelse ($sizeView as $sizeViews)
                                                                        <option @if ($product->size_id ==  $sizeViews->id )selected @endif value="{{ $sizeViews->id }}">{{  $sizeViews->size_name }}</option>
                                                                    @empty
                                                                        <option value class="text-danger">empty</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{-- size end  --}}
                                                        {{-- regular price  start --}}
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="rPrice">Regular Price <span class="text-danger">*</span> </label>
                                                                <input type="text" name="rPrice[]" value="{{ $product->regular_price }}" class="form-control @error('rPrice[]') is-invalid @enderror" id="rPrice">
                                                                @error('rPrice[]')
                                                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        {{-- regular price end --}}
                                                        {{-- offer price start --}}
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="ofrPrice">Offer Price</label>
                                                                <input type="text" name="ofrPrice[]" value="{{ $product->offer_price }}" class="form-control @error('ofrPrice[]') is-invalid @enderror" id="ofrPrice">
                                                                @error('ofrPrice[]')
                                                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        {{-- offer price end --}}
                                                        {{-- quantity start --}}
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="quantity">Quantity <span class="text-danger">*</span> </label>
                                                                <input type="number" name="quantity[]" value="{{ $product->quantity }}" class="form-control @error('quantity') is-invalid @enderror" id="quantity">
                                                                @error('quantity')
                                                                    <div class="text-danger fa fa py-2 pl-2"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                         {{-- quantity end --}}

                                                        <div class="col-md-2 remove-field outline-danger text-white my-auto">
                                                            <span class="text-danger" style="cursor:pointer"><i class=" fas fa-minus-circle"></i> Remove</span>
                                                        </div>
                                                    </div> <!--row-->
                                                @endforeach
                                            </div>
                                            {{-- attribute field remove button  --}}

                                        </div>
                                    </div>
                                {{-- new attribute add button  --}}
                                <button type="button" class="add-field btn-sm btn-primary ">Add field</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                {{-- form submit button  --}}
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
@section('footer_js')
  <script>
    $('#product_title').keyup(function() {
      $('#product_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
    /*
    ** Subcategory view by click category
    */
    $('#category_id').change(function(){
      var cat_id = $(this).val();
      if(cat_id){
        $.ajax({
          type:"GET",
          url:"{{url('api/get-subcat-list')}}/"+cat_id,
          success:function(res){
            if(res){
                $("#subCategory").empty();
                $("#subCategory").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#subCategory").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                });

            }else{
                $("#state").empty();
            }
          }
        });
      }else{

      }
    });
    // Dynamic Add/Remove Field start
    // $('.multi-field-wrapper').each(function() {
    //     var $wrapper = $('.multi-fields', this);
    //     $(".add-field", $(this)).click(function(e) {
    //         $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    //     });
    //     $('.multi-field .remove-field', $wrapper).click(function() {
    //         if ($('.multi-field', $wrapper).length > 1)
    //             $(this).parent('.multi-field').remove();
    //     });
    // });
    $('.multi-field-wrapper').each(function(){
        var $wrapper = $('.multi-fields', this);
        $('.add-field').click(function(){
            $('.multi-field-r-item:first-child').clone(true).appendTo($wrapper).find('input').val('');
        });
        $('.remove-field').click(function(){
            if($('.multi-field-r-item', $wrapper).length >1){
                $(this).parent('.multi-field-r-item').remove();
            }
        });
    });
    // Dynamic Add/Remove Field end
  </script>
@endsection
{{-- for active sidebar menu code start --}}
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
{{-- for active sidebar menu code end --}}
