<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900"
        rel="stylesheet" />
    {{--
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
        rel="stylesheet" /> --}}

    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}" />
    {{-- <link rel="stylesheet" href="/css/styles.css"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.10.0/bootstrap-maxlength.min.js"
        integrity="sha512-04L+TAgzlDAaUpaEGriEBg/qEryUjw4GNL/FkxA3h621EFPycccO2Y8vNhvid9UhgGC/9+MHLAFwGythpvOAAQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <title>SI Perpus | SMP Negeri 03 Kota Bengkulu</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('argon/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('argon/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('argon/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('argon/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('dashboard.partialsnew.sidebar')
    <main class="main-content position-relative border-radius-lg ">
        @include('dashboard.partialsnew.navbar')
        <div class="container-fluid py-4">
            @yield('container')
        </div>
    </main>

    </div>
</body>

<script src="{{ asset('argon/js/plugins/chartjs.min.js') }}"></script>
<script>
    $(document).ready(function() {

        [...document.querySelectorAll('.first-column')].map(column => {
            column.style.setProperty('--animation', 'slide');
            column.style.setProperty('height', '200%');
            column.innerHTML = column.innerHTML + column.innerHTML;
        });

    });
</script>
<script>
    $(window).on('load', function() {
        $(".loadding-page").delay(1000).fadeOut(200);
        $(".cssload-box-loading").on('click', function() {
            $(".cssload-box-loading").fadeOut(200);
        })
    })
</script>


</html>