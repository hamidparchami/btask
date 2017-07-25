@extends('layouts.front')
@section('header_links')
    <!-- Include js plugin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
@endsection

@section('header_scripts')
    <script>
        $(document).ready(function() {



        });
    </script>
@endsection

@section('main')
    <div class="container">
        <div class="row" style="margin-top: 25px;">
            <div class="col-md-8" style="border: 1px solid #CCCCCC;">
                <div class="row" id="filtered_products_container">
                    @php($j=1)
                    @foreach($products as $product)
                        <div class="col-md-4 text-center" style="border: 1px solid #fafafa;">
                            <img src="{{ $product->image_url }}" width="100%">
                            {{ $product->title }}<br>
                            <button class="bg-primary">Buy</button>
                        </div>
                        @if(0 == $j % 3)
                </div>
                <div class="row">
                    @endif
                    @php($j++)
                    @endforeach
                </div>
            </div>
            <div class="col-md-4" style="border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-md-12 rtl">
                        <strong>دسته‌بندی‌ها</strong><hr>
                        @foreach($categories as $category)
                            <input class="category-filter" type="checkbox" data-id="{{ $category->id }}"> {{ $category->title }}<br>
                        @endforeach
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-12 rtl">
                        <strong>ویژگی‌ها</strong><hr>
                        @foreach($attributes as $attribute)
                            » <strong>{{ $attribute->title }}</strong><br>
                            @foreach($attribute->valuesInProducts as $value)
                                <input class="attribute-filter" type="checkbox" data-id="{{ $value->value }}"> {{ $value->value }}<br>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script language="JavaScript">
        $(document).ready(function() {
            var categories_id  = [];
            var attributes_id  = [];

            $('.category-filter').click(function(){
                if($(this).is(":checked")){
                    categories_id.push($(this).data('id'));
                }
                else if($(this).is(":not(:checked)")){
                    categories_id.splice($.inArray($(this).data('id'), categories_id),1);
                }

                console.log(categories_id);
                $("#loading-mask").show();

                $.ajax({
                    type: "GET",
                    url: "/product/filtered",
                    data: {'categories_id':categories_id, '_token': $('input[name=_token]').val()},
                    success:function(data){
                        $("#filtered_products_container").html(data);
                        $("#loading-mask").hide();
                    }, error:function(jqXhr){
                        $("#loading-mask").hide();
                        alert('An error has occurred!');
                    }
                });
            });

            /* filter products by attribute value */
            $('.attribute-filter').click(function(){
                if($(this).is(":checked")){
                    attributes_id.push($(this).data('id'));
                }
                else if($(this).is(":not(:checked)")){
                    attributes_id.splice($.inArray($(this).data('id'), attributes_id),1);
                }

                console.log(attributes_id);
                $("#loading-mask").show();

                $.ajax({
                    type: "GET",
                    url: "/product/filtered",
                    data: {'attributes_id':attributes_id, '_token': $('input[name=_token]').val()},
                    success:function(data){
                        $("#filtered_products_container").html(data);
                        $("#loading-mask").hide();
                    }, error:function(jqXhr){
                        $("#loading-mask").hide();
                        alert('An error has occurred!');
                    }
                });
            });

        });
    </script>
@endsection