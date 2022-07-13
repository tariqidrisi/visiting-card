<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@500&family=Kdam+Thmor+Pro&family=Libre+Franklin:wght@100&display=swap" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- CSS Files -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />

    <style>
        .main-panel {
            overflow-y: scroll !important;
        }
    </style>

    @yield('style')

</head>
<body>
    <div id="app">
        @include('sweetalert::alert')
        <main class="">

            <div class="wrapper ">
                @include('backend.includes.sidebar')
                <div class="main-panel">
                    @include('backend.includes.header')

                    @yield('content')

                    @include('backend.includes.footer')
                </div>
            </div>


        </main>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js" integrity="sha512-X41/A5OSxoi5uqtS6Krhqz8QyyD8E/ZbN7B4IaBSgqPLRbWVuXJXr9UwOujstj71SoVxh5vxgy7kmtd17xrJRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--  Google Maps Plugin    -->
{{--    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}
    <!--  Notifications Plugin    -->
    <script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" ></script>
    <script src="{{ asset('js/paper-dashboard.min.js?v=2.0.1') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            var span = document.getElementById('time');

            function time() {
                var d = new Date();
                var s = d.getSeconds();
                var m = d.getMinutes();
                var h = d.getHours();
                span.textContent =
                    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
            }

            setInterval(time, 1000);
        })

        function deleteRecord(id) {
            var url = '/delete-records/'+ id;
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        }



    </script>

    @yield('js')

</body>
</html>
