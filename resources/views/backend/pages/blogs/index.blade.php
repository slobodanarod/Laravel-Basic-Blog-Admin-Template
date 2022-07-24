@extends('backend.layouts.master')
@section('title','List Blogs')
@section('add_custom')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>

<script defer>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('.show_confirm').click(function(event) {
             var form =  $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             swal({
                 title: `Are you sure you want to delete this record?`,
                 text: "Eğer silersen bu blog yazısıyla ilgili her şey silinecek.",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
             })
             .then((willDelete) => {
               if (willDelete) {
                 form.submit();
               }
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
                    <h4 class="mb-sm-0">Blogs List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Blogs</a></li>
                            <li class="breadcrumb-item active">List Blog</li>
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
                                    <th>Status</th>
                                    <th>Tags</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>

                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td><img src="/{{ $blog->image }}" style="max-width: 100px;"></td>
                                        <td>{{ $blog->name }}</td>
                                        <td>{{ $blog->seo_title }}</td>
                                        <td>{{ $blog->status == 1 ? "Active" : "Deactive" }}</td>
                                        <td>{{ $blog->getTags() }}</td>
                                        <td>
                                            <a href="{{ route('admin.blog.edit',$blog->id) }}" class="btn btn-info">Edit</a>
                                                <form method="POST" action="{{ route('admin.blog.destroy', $blog->id) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                                </form>
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
