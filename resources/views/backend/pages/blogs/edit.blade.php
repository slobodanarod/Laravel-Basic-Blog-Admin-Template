@extends('backend.layouts.master')
@section('title','Edit Blog')
@section('add_custom')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>

        $(document).ready(function() {
            $('#summernote').summernote();

            $('#add_cat').click(() =>{
                $('#categories_area').append(`
                <div id="categories">
                            <label for="parent_id" class="form-label">Category <span class='btn btn-danger' id='remove_cat'>Remove -</span></label>
                                        <select class="form-select" name="cat_id[]" id="cat_id">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                            </select>
                    </div>
                `)
        });


        $('#categories_area').on('click', '#remove_cat', function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
        });

        });

    </script>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Blog</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Blogs</a></li>
                                <li class="breadcrumb-item active">Edit Blog</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            @include('backend.layouts.errors')

            <form method="post" action="{{ route('admin.blog.update',$blog->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label" for="name">Category Name</label>
                                    <input type="text" class="form-control" value="{{ $blog->name }}" name="name" id="name" placeholder="Enter category name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="image">Thumbnail Image</label>
                                    <input class="form-control" id="image" type="file" name="file" accept="image/png, image/gif, image/jpeg">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="seo_title">Seo Title</label>
                                    <input type="text" name="seo_title" value="{{ $blog->seo_title }}" class="form-control" id="seo_title" placeholder="Enter seo title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="seo_descr">Seo Description</label>
                                    <input type="text" class="form-control" value="{{ $blog->seo_descr }}" id="seo_descr" name="seo_descr" placeholder="Enter seo description">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="seo_keyw">Seo Keywords</label>
                                    <input type="text" class="form-control" value="{{ $blog->seo_keyw }}" id="seo_keyw" name="seo_keyw" placeholder="Enter seo keywords">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Content</label>
                                    <div>
                                        <textarea id="summernote" name="content">{{ $blog->content }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-lg-0">
                                            <label for="status-select" class="form-label">Type</label>
                                            <select class="form-select" id="status-select" name="status">
                                                <option {{ $blog->status == 0 ? "selected" : null  }} value="0" selected>Deactive</option>
                                                <option {{ $blog->status == 1 ? "selected" : null  }} value="1">Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-4">
                            <button type="submit" class="btn btn-success w-sm">Edit</button>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thumbnail Image</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <img style="max-width: 100%" src="/{{ $blog->image }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Category <span id="add_cat" class="btn btn-primary">Add Category +</span></h5>
                            </div>
                            <div class="card-body" id="categories_area">
                                @foreach($blog_cates as $cate)
                                    <div id="categories">
                                        <label for="parent_id" class="form-label">Category</label>
                                        <select class="form-select" name="cat_id[]" id="cat_id">
                                            @foreach($categories as $cat)
                                                <option {{$cate["id"] == $cat->id ? "selected" : null}} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Tags</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <label for="parent_id" class="form-label">separate with commas(tag,tag1,tag2)</label>
                                    <input type="text" value="{{  $tags }}" class="form-control" id="tags" name="tags" placeholder="Enter Tags">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
