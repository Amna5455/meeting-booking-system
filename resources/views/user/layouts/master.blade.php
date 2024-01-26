<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="image/favicon.png" type="image/png">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    @include('user.layouts.partials.styles')
    <style>
        .nice-select.wide .list{
            height: 300px;
            overflow-y: scroll;
            width : 200px;
        }
    </style>
</head>

<body>

    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="booking_table d_flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <div class="row">
                        <div class="col-12">
                            <x-alert></x-alert>
                        </div>
                        <div class="col-12 ">
                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
    @include('user.layouts.partials.scripts')
    @yield('js')
</body>

</html>
