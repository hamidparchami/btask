<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>فروشگاه اینترنتی</title>

    <!-- Styles -->
    <link href="/css/app.css?v=0.1" rel="stylesheet">
    <link href="/css/common.css?v=0.2" rel="stylesheet">
    @yield('header_links')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('header_scripts')
    <meta name="developer" content="Hamid Parchami">
</head>
<body>
<div id="loading-mask" class="loading"><div>لطفا کمی صبر کنید...</div></div>

<div class="container-fluid">
    <div class="row header">
        <div class="col-md-12 header">
            <div class="container">
                <div class="row">
                    <div class="col-md-1">
                            <a href="/admin"><div class="login-button">ورود</div></a>
                    </div>
                    <div class="col-md-3">
                        <input type="search" class="rtl search-field" placeholder="جستجو...">
                    </div>
                    <div class="col-md-8 text-right header-right-navigation">
                        <span><a href="/">صفحه نخست</a></span>
                        <span><a href="/product/list">لیست محصولات</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="padding: 0; margin: 0;">@yield('main')</div>
    </div>




</div>
@yield('footer_scripts')
</body>
</html>