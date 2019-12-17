@include('employee.layouts.header')
@include('employee.layouts.navbar')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <ol class="breadcrumb">

                @yield('breadcrumb')
            </ol>
        </section>
<br>
    <section class="content">
        @include('employee.layouts.message')
        @yield('content')
    </section>
</div>


@include('employee.layouts.footer')
