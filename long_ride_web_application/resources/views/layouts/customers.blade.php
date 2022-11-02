<!DOCTYPE html>
<html lang="en">

    <head>
        @include('includes.headerlinks')
        @stack('styles')
    </head>

    <body class="main-body app sidebar-mini {{(Auth::user()->is_customer()) ? '' : ''}}">
        @include('includes.loader')

        <div class="page">

            @include('includes.leftmenu')

            <!-- main-content -->
            <div class="main-content app-content">


                @include('includes.topbar')

                <!-- container -->
                <div class="container-fluid">


                    <!-- breadcrumb -->
                    <div class="breadcrumb-header justify-content-between">
                        <div class="my-auto">
                            <div class="d-flex">
                                <h4 class="content-title mb-0 my-auto">@yield('title')</h4>
                                @if (trim($__env->yieldContent('sub_title')))
                                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ @yield('sub_title')</span>
                                @endif
                            </div>
                        </div>
                        {{-- @include('includes.button-list') --}}

                    </div>
                    <!-- breadcrumb -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            @include('includes.alerts')

                            @yield('content')
                        </div>
                    </div>
                </div>
                <!-- /Container -->
            </div>
            <!-- /main-content -->

            {{-- @include('includes.rightmenu') --}}
            @include('includes.footer')


        </div>

        @include('includes.footerlinks')
        @stack('scripts')
    </body>

</html>
