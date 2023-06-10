<header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
            <span class=""><img src="{{asset('assets/images/logotopntech.png')}}" alt="" style="width: 100px; height:50px; object-fit: contain;"></span>
        </a>

        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
            <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">Home</a>
            <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('site.blogs') }}">Blog</a>
            <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">Support</a>

            @auth
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="bg-transparent border-0 text-dark">Logout</button>
            </form>
            @else
            <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('login') }}">Login</a>
            <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </div>

    <!-- <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Pricing</h1>
        <p class="fs-5 text-body-secondary">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div> -->
</header>