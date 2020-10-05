<!DOCTYPE html>
<html>
    @includeIf('layouts.headerScript')
    <body class="hold-transition skin-blue">

        <div class="wrapper">
            <!-- header -->
            @includeIf('layouts.header')
        <!-- color for side bar -->

            <!-- Nav Bar -->
            @includeIf('layouts.navbar')
            <!-- Content -->
                <div class="content-wrapper">
                    @yield('BreadCrumb')
                    
                    <section class="content">
                        @includeIf('layouts.errors')
                        @yield('content')
                        
                    </section>
                </div>
            <!-- End Content -->

            <!-- Footer -->
            @includeIf('layouts.footer')

        <!-- End Footer -->
        </div>
    </body>
</html>