<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.vendor_before')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
