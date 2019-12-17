@include('userVendor.layouts.header')
@include('userVendor.layouts.navbar')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <ol class="breadcrumb">

                @yield('breadcrumb')
            </ol>
        </section>
<br>
    <section class="content">
        @include('userVendor.layouts.message')
        @yield('content')
    </section>
</div>


@include('userVendor.layouts.footer')
