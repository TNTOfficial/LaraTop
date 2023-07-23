<nav class="sidebar sidebar-offcanvas h-100" style="overflow-x:hidden; overflow-y:auto;" id="sidebar">
    <ul class="nav">

        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="d-flex align-items-center">
                    <div class="nav-profile-image">
                        @if ($profileImage)
                        <img src="{{ asset('/storage/images/' . $profileImage) }}" alt="Profile Image">
                        @else
                        <!-- Display a default image if the profile image is not available -->
                        <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="Default Image">
                        @endif
                        <span class="login-status online"></span>
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                        <span class="text-secondary text-small">Project Manager</span>
                    </div>
                    <x-dropdown-link :href="route('user_profile.edit')" class="fa-solid fa-user-pen text-decoration-none fs-6 nav-profile-badge" style="color: #beabc2;">
                        {{ __('') }}
                    </x-dropdown-link>
                </div>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('users')}}">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('settings.index')}}">
                <span class="menu-title">Settings</span>
                <i class="mdi mdi-settings menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Authorization</span>
                <i class="mdi mdi-menu-right  menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('roles.index')}}">Roles</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('permissions.index')}}"> Permissions </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('slides.index')}}">
                <span class="menu-title">Slider Management</span>
                <i class="fa-solid fa-sliders menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('testimonials.index')}}">
                <span class="menu-title">Testimonials</span>
                <i class="fa-solid fa-microscope  menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('sponsors.index')}}">
                <span class="menu-title">Sponsors</span>
                <i class="fa-regular fa-handshake menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('futureEvents.index')}}">
                <span class="menu-title">Future Events</span>
                <i class="fa-solid fa-calendar-days menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('gallery.index')}}">
                <span class="menu-title">Gallery</span>
                <i class="fa-brands fa-envira menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('emails.index')}}">
                <span class="menu-title">Contact Us</span>
                <i class="fa-solid fa-address-card menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('blogs.index')}}">
                <span class="menu-title">Blogs</span>
                <i class="fa-solid fa-blog menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>