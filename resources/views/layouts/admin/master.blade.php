<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
  @include('layouts.admin.css')
  @yield('css')
  @yield('style')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.admin.navigation')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper d-flex justify-content-center align-items-center overflow-hidden vh-100">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.admin.sidebar')
      <!-- partial -->
      <div class="main-panel h-100" style="overflow-x:hidden; overflow-y:auto;">

        <div class="col-6">
          @yield('breadcrumb-title')
        </div>
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('layouts.admin.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  @include('layouts.admin.script')
  @yield('script')
</body>

</html>