@extends('layouts.app')

@section('header_links')
    <link href="/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection


@section('content')
    <div class="container main-container">
        @if (Session::has('message'))
            <div class="alert alert-success text-right rtl">{{ Session::get('message') }}</div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-primary" href="/admin/product/create">ساخت محصول</a>
            </div>
            <div class="col-md-6 text-right rtl">
                <h4>لیست محصولات</h4>
            </div>
        </div>
        <hr>
        <table id="dataTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>عملیات</th>
                <th>وضعیت</th>
                <th>دسته</th>
                <th name="right-direction">عنوان محصول</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>عملیات</th>
                <th>وضعیت</th>
                <th>دسته</th>
                <th name="right-direction">عنوان محصول</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <a href="/admin/product/edit/id/{{ $product->id }}/">ویرایش</a> |
                        <a class="delete" href="/admin/product/delete/id/{{ $product->id }}">حذف</a>
                    </td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->category->title }}</td>
                    <td>{{ $product->title }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('footer_scripts')
    <script type="text/javascript" charset="utf8" src="/js/dataTables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/dataTables/dataTables.bootstrap.min.js"></script>
    <script type="application/json" charset="utf-8" src="//cdn.datatables.net/plug-ins/1.10.12/i18n/Persian.json"></script>
    <script language="JavaScript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "/js/dataTables/i18n/Persian.json"
                },
                "columnDefs": [
                    { "width": "20%", "targets": [0,1] },
                    { className: "text-right", "targets": [ 3 ] }
                ]
            });

            $('.delete').click(function () {
                return window.confirm("آیا از عملیات حذف اطمینان دارید؟");
            });
        });
    </script>
@endsection