@extends('backend.layouts.master')
@section('title','Edit Your Account')
@section('add_custom')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Your Account</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Account</a></li>
                                <li class="breadcrumb-item active">Edit Your Account</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            @include('backend.layouts.errors')

            <form method="post" action="{{ route('admin.user.edit.post') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="name" placeholder="Enter category name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="image">Image</label>
                                    <input class="form-control" id="image" type="file" name="file" accept="image/png, image/gif, image/jpeg">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" name="email" disabled value="{{ $user->email }}" class="form-control" id="email" placeholder="Enter your email">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                                </div>

                            </div>
                        </div>

                        <div class="text-end mb-4">
                            <button type="submit" class="btn btn-success w-sm">Edit Account</button>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Image</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <img style="max-width: 100%" src="/{{ $user->image }}"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
