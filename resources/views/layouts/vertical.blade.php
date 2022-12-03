<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'دفع | Dafae')</title>

    <!-- END: Theme CSS-->
    @stack('seo')
    @include('includes.header')
</head>
<body>
    @yield('content')
</body>
    @include('includes.footer')
</html>
