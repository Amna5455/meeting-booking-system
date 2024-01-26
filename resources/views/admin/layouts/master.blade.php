<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('page_title')</title>
  @include('admin.layouts.partials.styles')
  <style>
    .card-header{
        background: #223e9c;
        color: white;
    }
  </style>
</head>
<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    @include('admin.layouts.partials.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      {{--  @include('admin.layouts.partials.header')  --}}
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         <div class="row">
            <div class="col-12">
                <x-alert></x-alert>
            </div>
            <div class="col-12 ">
                @yield('content')
            </div>
        </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
            @include('admin.layouts.partials.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include('admin.layouts.partials.scripts')

  @yield('js')
</body>

</html>
