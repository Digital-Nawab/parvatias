@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page header start -->
            <div class="row gutters">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$title}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                                <li class="breadcrumb-item active">{{$title}}</li>
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
                            <form method="post" action="{{ url('/add-category/' . ($category->id ?? '')) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Category Basic Info </h5>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Category Name</label>
                                                            <input type="text" class="form-control" id="category_name"
                                                                name="category_name" value="{{$category->category_name}}"
                                                                placeholder="Category Name" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="eMail">Category Url</label>
                                                            <input type="text" class="form-control" id="category_url"
                                                                name="category_url" value="{{$category->category_url}}"
                                                                placeholder="Category Url" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <label>Is Front</label>
                                                        <div class="form-group mb-2">
                                                            <select class="form-control" name="is_front">
                                                                <option value="no" {{$category->is_front == 'no' ? "selected" : ''}}>No</option>
                                                                <option value="yes" {{$category->is_front == 'yes' ? "selected" : ''}}>Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                        <label>Manu Type</label>
                                                        <div class="form-group mb-2">
                                                            <select class="form-control" name="menu_type">
                                                                <option value="none" {{$category->menu_type == 'none' ? "selected" : ''}}>None</option>
                                                                <option value="single" {{$category->menu_type == 'single' ? "selected" : ''}}>Single</option>
                                                                <option value="multi" {{$category->menu_type == 'multi' ? "selected" : ''}}>Multi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="phone">Category Image 252*252</label><br>
                                                            <input type="file" class="form-control" value="{{$category->category_image}}"
                                                                name="category_image">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="">
                                                            <div class="form-group mb-2">
                                                                <label for="phone">Banner image 1920*300</label>
                                                                <input type="file" class="form-control"
                                                                    name="category_banner">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row p-2 ">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Category Meta For SEO</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="eMail"> Meta Title</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="meta_title" value="{{$category->meta_title}}"
                                                                    placeholder="Product Meta Title" />
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="eMail">Meta Description</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="meta_description" value="{{$category->meta_description}}"
                                                                    placeholder="Product Meta Keyword" />
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="eMail"> Meta Keyword</label>
                                                                <textarea name="meta_keyword" placeholder="Product Meta Description" class="form-control" rows="5">
                                                                    {{$category->meta_keyword}}
                                                                </textarea>
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
                                        <button type="submit" class="btn btn-md btn-primary">Submit </button>
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
            const categoryNameInput = document.getElementById("category_name");
            const categoryUrlInput = document.getElementById("category_url");
            categoryNameInput.addEventListener("input", function() {
                var title = this.value.toLowerCase();
                var res = title.replace(/ /g, "-");
                categoryUrlInput.value = res;
            });
        });
    </script>
@stop
