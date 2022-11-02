{{-- @if (Auth::check())
@php
    $gender = Auth::user()->gender;
    $fullname = Auth::user()->first_name." ".Auth::user()->last_name;
@endphp
@endif --}}
<!-- main-header -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">

            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>

        </div>
        <div class="main-header-right">
            <ul class="nav">
                <li class="">

                </li>
            </ul>
            <div class="nav nav-item  navbar-nav-right ml-auto">

                <div class="nav-item full-screen fullscreen-button">
                    {{-- <br> --}}
                    <a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    {{-- @if ($gender == 'Female')
                        <a class="profile-user d-flex" href=""><img alt="" src="{{ asset('assets/img/faces/woman.png') }}"></a>
                    @else --}}
                        <a class="profile-user d-flex" href=""><img alt="" src="{{ asset('assets/img/faces/man.png') }}"></a>
                    {{-- @endif --}}
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                {{-- @if ($gender == 'Female')
                                    <div class="main-img-user"><img alt="" src="{{ asset('assets/img/faces/woman.png') }}" class=""></div>
                                    <div class="ml-3 my-auto" style="color: white"> {{$fullname}}
                                    </div>
                                @else --}}
                                    <div class="main-img-user"><img alt="" src="{{ asset('assets/img/faces/man.png') }}" class=""></div>
                                    <div class="ml-3 my-auto" style="color: white"> {{''}}
                                    </div>
                                {{-- @endif --}}
                            </div>
                        </div>

                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="bx bx-log-out"></i> Sign Out</a>
                        <form id="logout-form" action="{{url('/')}}" method="GET" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

