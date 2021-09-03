<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Manyyu'])
    @include('layouts.shared/head-css')

    @include('layouts.shared/footer-script')

    @livewireStyles
</head>

<body data-layout-mode="horizontal"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        @include('layouts.shared/topbar')

        @include('layouts.shared.horizontal')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                @yield('content')

            </div>
            <!-- content -->

            {{-- @include('layouts.shared/footer') --}}

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    {{-- @include('layouts.shared/right-sidebar') --}}

    @livewireScripts
</body>

</html>
