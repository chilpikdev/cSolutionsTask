@extends('layouts.page')

@section("title", "Products")

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Products</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </div>
    </div>
</div>
@stop

@section("content")
<div class="container-fluid">
<div class="row">
    <div class="col-12">
    <div class="card">
        @can('add-product')
        <div class="text-left" style="margin: 20px 0 0 20px">
            <a class="btn btn-success" href="{{ route("products.create") }}">
                <i class="fas fa-plus">
                </i>
                Add new Entry
            </a>
        </div>
        @endcan
        <!-- /.card-header -->
        <div class="card-body">
            <table id="myTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Quantiy</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Quantiy</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        let table = new DataTable('#myTable', {
            ajax: '/products/data',
            processing: true,
            serverSide: true,
            columns: [
                { data: 'id' },
                { data: 'title' },
                { data: 'quantiy' },
                { data: 'price' },
                { data: 'action' },
            ],
            columnDefs: [
                {
                    data: null,
                    defaultContent: '@can("edit-product")<button type="button" class="btn btn-sm btn-outline-light editButton"><i class="fas fa-pencil-alt"></i></button>@endcan @can("delete-product")<button type="button" class="btn btn-sm btn-outline-danger deleteButton" data-csrf="{{csrf_token()}}"><i class="fas fa-trash"></i></button>@endcan',
                    targets: -1,
                    orderable: false,
                },
                {
                    targets: -2,
                    orderable: false,
                },
            ]
        });

        table.on('click', '.editButton', function (e) {
            let data = table.row(e.target.closest('tr')).data();
            let link = '/products/' + data['id'] + '/edit';

            window.location.href = link;
        });

        table.on('click', '.deleteButton', function (e) {
            let data = table.row(e.target.closest('tr')).data();
            let link = '/products/' + data['id'];
            let csrf = $(this).data('csrf');

            $.confirm({
                text: "Are you sure you want to delete this data?",
                confirm: function(button) {
                    $.ajax({
                        url: link,
                        type: 'DELETE',
                        data: {'_token': csrf},
                        success: function (result) {
                            window.location.reload();
                        }
                    });
                },
                confirmButton: "Yes",
                cancelButton: "No"
            });
        });
    });
</script>
@stop
