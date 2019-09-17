<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.vendor_before')

        @yield('css')
    </head>

    <body onload="LoadingClose();">
        <div class="container">
        	@yield('content')
    	</div>

        @include('layouts.vendor_after')

        @yield('javascript')
    </body>
</html>
