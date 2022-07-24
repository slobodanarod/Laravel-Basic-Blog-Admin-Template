@extends('backend.layouts.master')
@section('title','Site Settings')
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
                    <h4 class="mb-sm-0">Settings List</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                            <li class="breadcrumb-item active">List Settings</li>
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
                                    <th>TAG</th>
                                    <th>VALUE</th>
                                    <th>TYPE</th>
                                    <th>MAIN</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>

                                    @foreach($settings as $setting)
                                    <tr>
                                        <td>{{ $setting->tag }}</td>
                                        <td>{{ $setting->value }}</td>
                                        <td>{{ $setting->type}}</td>
                                        <td>{{ $setting->main }}</td>
                                        <td>
                                            <a href="{{ route('admin.settings.edit',$setting->id) }}" class="btn btn-info">Edit</a>
                                        </td>
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
