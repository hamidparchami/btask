@extends('layouts.app')

@section('header_links')
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/awesome-bootstrap-checkbox.css">
@endsection

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
        <form id="form1" method="post">
            <div class="row">
                <div class="col-md-12 text-right">
                    <div class="panel panel-default">
                        <div class="panel-heading rtl">ساخت ویژگی</div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <input name="category_id" type="hidden" value="{{ $category_id }}">
                            <div class="row form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <input name="title" type="text" class="form-control rtl" value="{{ old('title') }}">
                                </div>
                                <div class="col-md-4">عنوان</div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-8">
                                    <textarea name="desc" class="form-control rtl" rows="4"></textarea>
                                </div>
                                <div class="col-md-4">توضیح</div>
                            </div>

                            <br />

                            <div class="row form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <select name="field_type" class="form-control rtl">
                                        <option value="text"> متنی </option>
                                        <option value="option"> چند گزینه‌ای </option>
                                        <option value="checkbox"> چک‌باکس </option>
                                    </select>
                                </div>
                                <div class="col-md-4">نوع فیلد</div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <label class="switch">
                                        <input name="is_active" type="checkbox" @if((old('is_active') == 'on')) checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-4">انتشار</div>
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
                                    <a href="/admin/attribute/manage/{{ $category_id }}" class="btn btn-warning">بازگشت</a>
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-4 text-left">
                                    <button type="submit" id="submit" class="btn btn-success">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="allowed_urls" id="allowed_urls" />
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