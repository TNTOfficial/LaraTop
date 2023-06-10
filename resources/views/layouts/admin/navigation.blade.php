
@php
    $userProfile = Auth::user()->userProfile;
@endphp

<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-around">
        <div>
            <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('assets/images/laratop.png')}}" alt="logo" /></a>

        </div>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/images/l2.png')}}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                             this.closest('form').submit();">
                            <i class="mdi mdi-logout me-2 text-primary"></i>{{ __('Sign Out') }}
                    </form>

                </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>