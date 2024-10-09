@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row gutters">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$title}}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{$title}}</a></li>
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
                            <form method="post" action="{{ url('/add-tag/' . ($tag->id ?? '')) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="row gutters">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Tag Basic Info </h5>
                                                </div>
                                                <div class="card-body row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="fullName">Tag Name</label>
                                                            <input type="text" class="form-control" id="tag_name"
                                                                name="tag_name" value="{{$tag->tag_name}}"
                                                                placeholder="Tag Name" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="eMail">Tag Url</label>
                                                            <input type="text" class="form-control" id="tag_url"
                                                                name="tag_url" value="{{$tag->tag_url}}"
                                                                placeholder="Tag Url" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group mb-2">
                                                            <label for="phone">Category Image 432*432</label><br>
                                                            <input type="file" class="form-control" name="tag_image">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="">
                                                            <div class="form-group mb-2">
                                                                <label for="phone">Banner image 1920*300</label>
                                                                <input type="file" class="form-control"
                                                                    name="tag_banner">
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
                                                    <h5 class="card-title mb-0">Tag Meta For SEO</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="eMail"> Meta Title</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="meta_title" value="{{$tag->meta_title}}"
                                                                    placeholder="Product Meta Title" />
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="eMail">Meta Description</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="meta_description" value="{{$tag->meta_description}}"
                                                                    placeholder="Product Meta Keyword" />
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="eMail"> Meta Keyword</label>
                                                                <textarea name="meta_keyword" placeholder="Product Meta Description" class="form-control" rows="5">
                                                                    {{$tag->meta_keyword}}
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
            const categoryNameInput = document.getElementById("tag_name");
            const categoryUrlInput = document.getElementById("tag_url");
            categoryNameInput.addEventListener("input", function() {
                var title = this.value.toLowerCase();
                var res = title.replace(/ /g, "-");
                categoryUrlInput.value = res;
            });
        });
    </script>
@stop
