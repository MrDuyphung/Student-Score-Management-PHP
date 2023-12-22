<!DOCTYPE html>
<html>
<head>
    <title>Student System</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">

    <!-- plugin css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!-- end plugin css -->



    {{--    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">--}}
    <!-- common css -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- end common css -->


</head>
<body data-base-url="{{url('/')}}">

<div class="container-scroller" id="app">
    @include('layout.headerStudent')
    <div class="container-fluid page-body-wrapper">
        @include('layout.sidebarStudent')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')

            </div>
                    @include('layout.footerStudent')
        </div>
    </div>
</div>

<!-- base js -->
<script src="{{asset('assets/js/app.js')}}" ></script>
{{--  <script src="{{asset('assets/js/todolist.js')}}"></script>--}}
<script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<!-- end base js -->

<!-- plugin js -->

<!-- end plugin js -->

<!-- common js -->
<script src="{{asset('assets/js/off-canvas.js')}}"></script>
<script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('assets/js/misc.js')}}"></script>
<script src="{{asset('assets/js/settings.js')}}"></script>
<script src="{{asset('assets/js/todolist.js')}}"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- end common js -->
<script>
    var myTextElement = document.getElementById('myText');
    setTimeout(function () {
        myTextElement.style.display = 'none';
    }, 3000);
</script>


</body>
</html>
