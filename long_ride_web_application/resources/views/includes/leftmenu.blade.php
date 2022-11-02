@push('styles')
    <style>
        .side-menu .slide.active .side-menu__label,
        .side-menu .slide.active .side-menu__icon {
            color: #8ad8ff !important;
        }
    </style>
@endpush

<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/') }}"><img src="{{ asset('images/bg_img.png') }}"
                class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/') }}"><img src="{{ asset('images/bg_img.png') }}"
                class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}"><img
                src="../../assets/img/brand/favicon.png" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}"><img
                src="../../assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ asset('assets/img/faces/man.png') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ 'Admin' }}</h4>
                    <span class="mb-0 text-success">{{ 'Active' }}</span>
                </div>
            </div>
        </div>

        <ul class="side-menu">
            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i
                        class="fe fe-layers"></i>&nbsp;&nbsp;<span class="side-menu__label">Dashboard</span></a>
            </li>

            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i
                        class="fe fe-users"></i>&nbsp;&nbsp;<span class="side-menu__label">Passengers</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('passenger_index') }}">All Passengers</a></li>
                    <li><a class="slide-item" href="{{ route('passenger_view', ['action' => 'Add']) }}">Add
                            Passenger</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i
                        class="fe fe-user"></i>&nbsp;&nbsp;<span class="side-menu__label">Inspectors</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/ticketInspector/index') }}">All Inspectors</a></li>
                    <li><a class="slide-item" href="{{ route('createTicketInspector_view') }}">Add Inspector</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i
                        class="fe fe-git-pull-request"></i>&nbsp;&nbsp;<span class="side-menu__label">Routes</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('route_index', ['action' => '']) }}">All Routes</a></li>
                    <li><a class="slide-item" href="{{ route('route_view', ['action' => 'add', 'id' => '']) }}">Add
                            Routes</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i
                        class="fe fe-credit-card"></i>&nbsp;&nbsp;<span class="side-menu__label">Card Types</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('card_index', ['action' => '']) }}">All Card Types</a></li>
                    <li><a class="slide-item" href="{{ route('card_view', ['action' => 'add', 'id' => '']) }}">Add Card
                            Type</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i
                        class="fe fe-book-open"></i>&nbsp;&nbsp;<span class="side-menu__label">Reports</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/report') }}">All Reports</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i
                        class="fe fe-settings"></i>&nbsp;&nbsp;<span class="side-menu__label">Settings</span></a>
            </li>

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
