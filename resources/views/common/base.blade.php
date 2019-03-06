<html>
    <head>
        <title>应用程序名称 - @yield('title')</title>
        <script type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        @section('sidebar')
            这是主布局的侧边栏。
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>