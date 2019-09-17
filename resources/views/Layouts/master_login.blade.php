<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.vendor_before')

        @yield('css')
    </head>

    <body class="hold-transition login-page" onload="LoadingClose();">
        @yield('content')

        @include('layouts.vendor_after')

        @yield('javascript')
    </body>
</html>
