@extends('backend.layouts.master')
@section('title','Edit Blog')
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
                        <h4 class="mb-sm-0">Edit Settings</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Edit Settings</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            @include('backend.layouts.errors')

            <form method="post" action="{{ route('admin.settings.update',$setting->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="tag">TAG</label>
                                    <input type="text" class="form-control" value="{{ $setting->tag }}" name="tag" id="tag" disabled value={{$setting->tag}}>
                                </div>

                            @if($setting->type == "Text")

                                <div class="mb-3">
                                    <label class="form-label" for="value">Value</label>
                                    <input type="text" class="form-control" value="{{ $setting->value }}" id="value" name="value" value={{$setting->value}}>
                                </div>
                            @elseif($setting->type == "TextArea")

                            <div class="mb-3">
                                <label class="form-label">Value</label>
                                <div>
                                    <textarea class="form-control" name="value">{{ $setting->value }}</textarea>
                                </div>
                            </div>

                            @elseif($setting->type == "Image")

                            <div class="mb-3">
                                <label class="form-label">Value</label>
                                <div>
                                    <input type="file" class="form-control" name="value"/>
                                </div>
                            </div>


                            @endif

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-lg-0">
                                            <label for="status-select" class="form-label">Type</label>
                                            <select class="form-select" id="status-select" name="type">
                                                @foreach ($types as $type)
                                                   <option {{ $setting->type == $type ? "selected" : null  }} value="{{$type}}" >{{$type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-lg-0">
                                            <label for="status-select" class="form-label">Main</label>
                                            <select class="form-select" id="status-select" name="type">
                                                @foreach ($mains as $main)
                                                   <option {{ $setting->main == $main ? "selected" : null  }} value="{{$main}}" >{{$main}}</option>
                                                @endforeach
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

                    @if($setting->type == "Image")
                        <div class="col-lg-4">

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Thumbnail Image</h5>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <img style="max-width: 100%" src="/{{ $setting->value }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
