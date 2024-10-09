@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page header start -->
        <div class="row gutters">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ $title }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page header end -->

        <div class="row gutters">
            <div class="col-12">
                <!-- Wizard start -->
                <div id="example-form">
                    <section>
                        <div id="message-container">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (Session::has('success_msg'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ Session('success_msg') }}</strong>
                            </div>
                            @endif
                            @if (Session::has('error_msg'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ Session('error_msg') }}</strong>
                            </div>
                            @endif
                        </div>
                        <form method="post" action="{{ url('/add-product/' . ($product->id ?? '')) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row gutters">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Product Meta For SEO</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="meta_title">Meta Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}" placeholder="Product Meta Title" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="meta_keyword">Meta Keyword</label>
                                                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword', $product->meta_keyword) }}" placeholder="Product Meta Keyword" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="meta_description">Meta Description</label>
                                                            <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ old('meta_description', $product->meta_description) }}" placeholder="Product Meta Description" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Product Basic Info Section -->
                                    <div class="row gutters">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Product Basic Info</h5>
                                            </div>
                                            <div class="card-body row">
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="product_name">Product Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" placeholder="Product Name" required />
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="product_price">Product Price <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="product_price" name="product_price" value="{{ old('product_price', $product->product_price) }}" placeholder="Product Price" required />
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="stock_quantity">Stock Quantity <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" placeholder="Stock Quantity" required />
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="product_url">Product URL <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="product_url" name="product_url" value="{{ old('product_url', $product->product_url) }}" placeholder="Product URL" required />
                                                    </div>
                                                </div>
                        
                                                <!-- Category and Gender Selection -->
                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                                    <label>Select Category <span class="text-danger">*</span></label>
                                                    <div class="form-group mb-3">
                                                        @if(count($category) != 0)
                                                        <select class="form-control" name="category_id" required>
                                                            @foreach($category as $row)
                                                            <option value="{{ $row->id }}" {{ old('category_id', $product->category_id) == $row->id ? 'selected' : '' }}> {{ $row->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                                    <label>Shopping Gender <span class="text-danger">*</span></label>
                                                    <div class="form-group mb-3">
                                                        <select class="form-control" name="gender" required>
                                                            <option value="women" {{ old('gender', $product->gender) == 'women' ? 'selected' : '' }}>Women</option>
                                                            <option value="men" {{ old('gender', $product->gender) == 'men' ? 'selected' : '' }}>Men</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                                    <label>Product Status <span class="text-danger">*</span></label>
                                                    <div class="form-group mb-3">
                                                        <select class="form-control" name="is_sold" required>
                                                            <option value="1" {{ old('is_sold', $product->is_sold) == '1' ? 'selected' : '' }}>Sold In</option>
                                                            <option value="2" {{ old('is_sold', $product->is_sold) == '2' ? 'selected' : '' }}>Sold Out</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="product_image">Product Image 252*252 <span class="text-danger">*</span></label><br>
                                                        <input type="file" class="form-control" value="{{ old('product_image', $product->product_image) }}" name="product_image" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Product Long Description -->
                                    <div class="row gutters">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Product Details Content</h5>
                                            </div>
                                            <div class="card-body row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="long_description">Product Long Description</label>
                                                        <textarea name="long_description" placeholder="Product Long Description" class="form-control" rows="5">{{ old('long_description', $product->long_description) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Product Detail Section -->
                                <div class="col-md-4">
                                    <div class="row p-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Product Detail</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="product_metal">Product Metal Use</label>
                                                            <input type="text" class="form-control" id="product_metal" name="product_metal" value="{{ old('product_metal', $product->meta_description) }}" placeholder="18 KT Rose Gold, Red Stone" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="product_material">Product Material</label>
                                                            <input type="text" class="form-control" id="product_material" name="product_material" value="{{ old('product_material', $product->product_material) }}" placeholder="Silver, Gold, Diamond" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="product_metal_purity">Product Metal Purity</label>
                                                            <input type="text" class="form-control" id="product_metal_purity" name="product_metal_purity" value="{{ old('product_metal_purity', $product->product_metal_purity) }}" placeholder="99, 24k 22k" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="product_size">Product Size</label>
                                                            <input type="text" class="form-control" id="product_size" name="product_size" value="{{ old('product_size', $product->product_size) }}" placeholder="20" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="product_width">Product Width</label>
                                                            <input type="text" class="form-control" id="product_width" name="product_width" value="{{ old('product_width', $product->product_width) }}" placeholder="0.81 Cm" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="product_height">Product Height</label>
                                                            <input type="text" class="form-control" id="product_height" name="product_height" value="{{ old('product_height', $product->product_height) }}" placeholder=" 99, 24k 22k" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="approx_gross_weight">Gross Weight</label>
                                                            <input type="text" class="form-control" id="approx_gross_weight" name="approx_gross_weight" value="{{ old('approx_gross_weight', $product->approx_gross_weight) }}" placeholder="1.911" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group mb-3">
                                                            <label for="short_description">Product Description <span class="text-danger">*</span></label>
                                                            <textarea name="short_description" placeholder="Product Description" required class="form-control" rows="5">{{ old('short_description', $product->short_description) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const productNameInput = document.getElementById("product_name");
        const productUrlInput = document.getElementById("product_url");

        productNameInput.addEventListener("input", function() {
            var title = this.value.toLowerCase();
            var res = title.replace(/ /g, "-");
            productUrlInput.value = res;
        });
    });
</script>
@stop
