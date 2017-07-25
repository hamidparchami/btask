@extends('layouts.app')

@section('content')
<div class="container main-container">
    @if (count($errors) > 0)
        <div class="alert alert-danger rtl">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if((isset($category->id)))
        <div class="row">
            <div class="col-md-12">
                <a href="/admin/attribute/manage/{{ $category->id }}" class="btn btn-primary">ویژگی‌های دسته</a>
            </div>
        </div>
        <hr>
    @endif

    <form method="post">
        <div class="row">
            <div class="col-md-12 text-right">
                <div class="panel panel-default">
                    <div class="panel-heading">ایجاد/ویرایش دسته</div>
                    <div class="panel-body">
                        {{ csrf_field() }}
                        <input name="parent_id" type="hidden" value="{{ (isset($parent_id) ? $parent_id : 0) }}">
                        <div class="row form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <input name="title" type="text" class="form-control rtl" value="{{ old('title', (isset($category->title)) ? $category->title : '') }}">
                            </div>
                            <div class="col-md-4">عنوان دسته</div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-8">
                                <textarea name="desc" class="form-control rtl" rows="4">{{ old('desc', (isset($category->desc)) ? $category->desc : '') }}</textarea>
                            </div>
                            <div class="col-md-4">توضیح</div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <input name="url_key" type="text" class="form-control" value="{{ old('url_key', (isset($category->url_key)) ? $category->url_key : '') }}">
                            </div>
                            <div class="col-md-4">Url Key</div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <input name="order" type="text" class="form-control" value="{{ old('order', (isset($category->order)) ? $category->order : '') }}">
                            </div>
                            <div class="col-md-4">ترتیب</div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <label class="switch">
                                    <input name="is_active" type="checkbox" @if((old('is_active') == 'on') || (isset($category->is_active) && $category->is_active) == 1)) checked @endif>
                                    <div class="slider round"></div>
                                </label>
                            </div>
                            <div class="col-md-4">وضعیت</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="action_buttons">
            <div class="col-md-12 text-right">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-xs-4 text-left">

                            </div>
                            <div class="col-md-9 col-sm-4 col-xs-4">
                                <a href="/admin/category/manage" class="btn btn-warning">بازگشت</a>
                            </div>
                            <div class="col-md-1 col-sm-4 col-xs-4 text-left">
                                <button type="submit" id="submit" class="btn btn-success">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection

@section('footer_scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    var ckeditor = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
        contentsLangDirection: 'rtl',
        enterMode: CKEDITOR.ENTER_BR,
        allowedContent: true,
    };

    CKEDITOR.replace( 'desc', ckeditor);
</script>
@endsection