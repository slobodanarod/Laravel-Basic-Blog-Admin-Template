@extends('backend.layouts.master')
@section('title','Edit Category')
@section('add_custom')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>

$(document).ready(function() {
  $('#summernote').summernote();
});

</script>
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Category</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        @include('backend.layouts.errors')

        <form method="post" action="{{ route('admin.categories.update',$category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label" for="name">Category Name</label>
                                <input type="text" class="form-control" value="{{ $category->name }}" name="name" id="name" placeholder="Enter category name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="image">Thumbnail Image</label>
                                <input class="form-control" id="image" type="file" name="file" accept="image/png, image/gif, image/jpeg">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="seo_title">Seo Title</label>
                                <input type="text" name="seo_title" value="{{ $category->seo_title }}" class="form-control" id="seo_title" placeholder="Enter seo title">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="seo_descr">Seo Description</label>
                                <input type="text" class="form-control" value="{{ $category->seo_descr }}" id="seo_descr" name="seo_descr" placeholder="Enter seo description">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="seo_keyw">Seo Keywords</label>
                                <input type="text" class="form-control" value="{{ $category->seo_keyw }}" id="seo_keyw" name="seo_keyw" placeholder="Enter seo keywords">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <div>
                                    <textarea id="summernote" name="content">{{ $category->content }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="type" class="form-label">Type</label>
                                        <select class="form-select" id="type" name="type">
                                            @foreach($types as $type)
                                                 <option {{ $category->type == $type ? "selected" : null  }} value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="status-select" class="form-label">Type</label>
                                        <select class="form-select" id="status-select" name="status">
                                            <option {{ $category->status == 0 ? "selected" : null  }} value="0" selected>Deactive</option>
                                            <option {{ $category->status == 1 ? "selected" : null  }} value="1">Active</option>
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
                                <img style="max-width: 100%" src="/{{ $category->image }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Parent Category</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="parent_id" class="form-label">Category</label>
                                <select class="form-select" name="parent_id" id="parent_id">
                                    <option {{ $category->parent_id == 0 ? "selected" : null  }} value="0" selected>Parent</option>
                                    @foreach($categories as $cat)
                                        <option {{ $category->parent_id == $cat->id ? "selected" : null  }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        </form>
    </div>
</div>
@endsection
