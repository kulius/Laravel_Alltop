<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.vendor_before')

        @yield('css')
    </head>

    <body class="hold-transition sidebar-mini" onload="LoadingClose();">
        <div class="wrapper" id="app" style="height: 100vh;">
            <div class="modal fade" role="dialog" id="modal"></div>

            @include('layouts.navbar')

            @include('layouts.sidebar')

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                            @if ($head)
                                <h1 class="m-0 text-dark">{{ $head['menu_name'] }}</h1>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @if ($bread)
                                    @foreach ($bread as $key => $value)
                                        <li class="breadcrumb-item">{{ $value }}</li>
                                    @endforeach
                                @endif
                            </ol>
                        </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>
            </div>

            @include('layouts.footer')
        </div>

        @include('layouts.vendor_after')

        @yield('javascript')
    </body>
</html>
