@extends('backend.layouts.master')
@section('title','List Category')
@section('add_custom')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>

<script defer>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
    </script>
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Category List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                            <li class="breadcrumb-item active">List Category</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        @include('backend.layouts.errors')

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="categories">
                    <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered">
                               <thead>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Seo Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Parent</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>

                                    @foreach($categories as $category)
                                    <tr>
                                        <td><img src="/{{ $category->image }}" style="max-width: 100px;"></td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->seo_title }}</td>
                                        <td>{{ $category->type }}</td>
                                        <td>{{ $category->status == 1 ? "Active" : "Deactive" }}</td>
                                        <td>{{ $category->getParentsNames() }}</td>
                                        <td><a href="{{ route('admin.categories.edit',$category->id) }}" class="btn btn-info">Edit</a></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                </div>
            </div>
            </div>
        </div>

    </div>
</div>
@endsection
