<header class="main-header" style="background:#26b1b0;" >
    <!-- Logo -->
    <a href="{{route('vendorHome')}}" class="logo" style="background:#26b1b0;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini col-xs-12 col-sm-12"><b>V</b></span>
        <!-- logo for regular state and mobile devices -->
        <span id="otI" class="logo-lg hidden-xs hidden-sm">Venoola</span>
        <span id="ot" class="hidden-md hidden-lg col-xs-12 col-sm-12"><b>V</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background:#26b1b0;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle once1" data-toggle="push-menu" role="button" >
            <span class="sr-only">Toggle navigation</span>
        </a>

     @include('userVendor.layouts.menu')
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li id >
                <a class="{{session()->get('menu') == 'markets' ? 'activeitem' : ''}}" href="{{route('VendorMarket.index',auth()->guard('vendor')->user()->id)}}">
                    <i class="fa fa-shopping-cart"></i> <span>Markets</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li id >
                <a class="{{session()->get('menu') == 'category' ? 'activeitem' : ''}}" href="{{route('vendorallCategories.index')}}">
                    <i class="fa fa-list-alt"></i> <span>Categories</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li>
                <a class="{{session()->get('menu') == 'employees' ? 'activeitem' : ''}}" href="{{route('vendorEmployees.index',auth()->guard('vendor')->user()->id)}}">
                    <i class="fa fa-users"></i> <span>Employees</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
