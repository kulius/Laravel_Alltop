<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!--  <div class="brand-link">
        <img>
    </div> -->

    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-dark"> {{ session('school_name') }} </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" id='sidebar'>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/img/profile.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ session('user_name') }} </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview {!! classActivePath(1,'dashboard') !!}" style="width:100%;">
                    <a href="{!! route('home') !!}" class="nav-link {!! classActiveSegment(1, 'dashboard') !!}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            首頁區
                        </p>
                    </a>
                </li>

                @foreach ($menu as $key => $value)
                    <li class="nav-header">{{ _i($value['header']) }}</li>

                    @foreach ($value['item'] as $key_item => $value_item)
                        <li class="nav-item has-treeview  {!! classActivePath(1, $value_item['number']) !!}" style="width:100%;">
                            <a href="#" class="nav-link {!! classActiveSegment(1, $value_item['number']) !!}">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    {{ $value_item['text'] }}
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($value_item['submenu'] as $key_sub => $value_sub)
                                    <li class="nav-item">
                                        <a href="{{ route($value_sub['number']) }}" class="nav-link {!! classActiveSegment(2, $value_sub['number']) !!}">
                                            <i class="fas fa-circle nav-icon text-info" style="font-size: 0.3rem !important;"></i>
                                            <p>{{ $value_sub['text'] }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endforeach
            </ul>
         </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
