@extends('layouts.app')

@section('header_links')
    <link href="/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('header_scripts')

@endsection

@section('content')

<div class="container main-container">
    @if (Session::has('message'))
        <div class="alert alert-success text-right rtl">{{ Session::get('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary" href="/admin/category/create">ایجاد دسته</a>
        </div>
        <div class="col-md-6 text-right">
            <h4>مدیریت دسته‌ها</h4>
        </div>
    </div>
    <hr>
    <table id="dataTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th name="right-direction">عنوان دسته</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th name="right-direction">عنوان دسته</th>
        </tr>
        </tfoot>
        <tbody id="sortable">
        @foreach($categories as $category)
        <tr data-id="{{ $category->id }}">
            <td id="title" class="sortable-item-title rtl">
                <div class="menu-item">
                    @if($category->children->count())
                        <a id="collapse-row" class="collapse-row-link pointer none-decoration"><span class="collapse-row">+</span></a>
                    @endif
                    <strong class="@if($category->is_active != 1) line-through @endif">{{ $category->title }}</strong>
                    <span class="operation-links" style="display: none;">[ <a href="/admin/category/create/{{ $category->id }}">زیر دسته</a> | <a href="/admin/category/edit/id/{{ $category->id }}">ویرایش</a> | <a class="delete" href="/admin/category/delete/id/{{ $category->id }}">حذف</a>]</span>
                </div>
                <div id="menu-children-container" class="menu-children-container" style="display: none;">
                    @if($category->children->count())
                        @foreach($category->children as $child)
                            <div class="menu-item">
                                ¦- <span class="@if($child->is_active != 1) line-through @endif">{{ $child->title }}</span>
                                <span class="operation-links" style="display: none;">[ <a href="/admin/category/edit/id/{{ $child->id }}/{{ $category->id }}">ویرایش</a> | <a class="delete" href="/admin/category/delete/id/{{ $child->id }}">حذف</a> ]</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </td>
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
            $('#dataTable1').DataTable({
                "language": {
                    "url": "/js/dataTables/i18n/Persian.json"
                },
                "columnDefs": [
                    { className: "text-right", "targets": [0] }
                ]
            });

            $('.delete').click(function () {
                return window.confirm("آیا از عملیات حذف اطمینان دارید؟");
            });

            $('.collapse-row-link').click(function () {
                $(this).closest('.sortable-item-title').find('#menu-children-container').toggle();
            });

            $('.menu-item').mouseover(function () {
                $(this).find('.operation-links').show();
            });

            $('.menu-item').mouseout(function () {
                $(this).find('.operation-links').hide();
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        var jq = $.noConflict();
        jq(document).ready(function() {
            jq( "#sortable" ).sortable({
                placeholder: "sortable-placeholder",
                start: function(event, ui){
                    var text = $.trim(ui.item.find('#title').text());
                    ui.item.startHtml = ui.item.html();

                    ui.item.html('<div style="display:" class="rf-ind-drag default drag">' + text + '</div>');
                },
                stop: function(event, ui){
                    ui.item.html(ui.item.startHtml);
                },
                update: function(event, ui) {
//                    alert(ui.item.data('id'));
                    console.log(ui.item.context.rowIndex);
                    $("#loading-mask").show();
                    $.ajax({
                        type: 'POST',
                        url: '/admin/menu/change-order/id/' + ui.item.data('id'),
                        data: {'order': ui.item.context.rowIndex, '_token': $('input[name=_token]').val()},
                        success:function(data){
                            $("#loading-mask").hide();
                            //do something
                            console.log(data);
                        }, error:function(jqXhr){
                            $("#loading-mask").hide();
                            console.log(jqXhr);
                            alert('خطایی رخ داده است لطفا دوباره سعی کنید.');
                        }

                    });
//                    console.log(ui);
                }

            });
            jq( "#sortable" ).disableSelection();
        } );
    </script>
@endsection