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
                        <div class="panel-heading rtl">ویرایش محصول</div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="row form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <input name="title" type="text" class="form-control rtl" value="{{ (old('title')) ?: $product->title }}">
                                </div>
                                <div class="col-md-4">عنوان</div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <input name="model" type="text" class="form-control rtl" value="{{ (old('model')) ?: $product->model }}">
                                </div>
                                <div class="col-md-4">مدل</div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-8">
                                    <textarea name="desc" class="form-control rtl" rows="4">{{ (old('desc')) ?: $product->desc }}</textarea>
                                </div>
                                <div class="col-md-4">توضیح</div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-8">
                                    <div class="input-group">
                                      <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                          <i class="fa fa-picture-o"></i> انتخاب
                                        </a>
                                      </span>
                                        <input id="thumbnail" class="form-control" type="text" name="image_url" value="{{ (old('image_url', (isset($product->image_url) ? $product->image_url : ''))) }}">
                                    </div>
                                    <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ (isset($product->image_url) ? $product->image_url : '') }}">
                                </div>
                                <div class="col-md-4">عکس</div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <input name="price" type="text" class="form-control" value="{{ (old('price')) ?: $product->price }}">
                                </div>
                                <div class="col-md-4">قیمت</div>
                            </div>

                            <div class="row form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <input name="quantity" type="text" class="form-control" value="{{ (old('quantity')) ?: $product->quantity }}">
                                </div>
                                <div class="col-md-4">تعداد موجودی</div>
                            </div>


                            <hr />
                            @foreach($product->attributes as $attribute)
                                <div class="row form-row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input name="attribute_id[]" type="hidden" value="{{$attribute->id}}">
                                        <input name="attribute_value[]" type="text" class="form-control rtl" value="{{ (old("attribute_value[]")) ?: $attribute->value }}">
                                    </div>
                                    <div class="col-md-4">{{ $attribute->attribute->title }}</div>
                                </div>
                            @endforeach
                            <hr />

                            <br />

                            <div class="row form-row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <select name="status" class="form-control rtl">
                                        <option value="Available" @if((isset($product->status) && $product->status == 'Available') || (old('status') == 'Available')) selected @endif> موجود </option>
                                        <option value="Not Available" @if((isset($product->status) && $product->status == 'Not Available') || (old('status') == 'Not Available')) selected @endif> عدم موجودی </option>
                                        <option value="Available and Coming Soon" @if((isset($product->status) && $product->status == 'Available and Coming Soon') || (old('status') == 'Available and Coming Soon')) selected @endif> بزودی </option>
                                    </select>
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
                                    <a href="/admin/product/manage" class="btn btn-warning">بازگشت</a>
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

    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        $('#lfm').filemanager('image');
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