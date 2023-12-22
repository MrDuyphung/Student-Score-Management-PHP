<!DOCTYPE html>
<html>
<head>
    <title>Lecturer System</title>
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
    @include('layout.headerLecturer')
    <div class="container-fluid page-body-wrapper">
                @include('layout.sidebarLecturer')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
                    @include('layout.footerLecturer')
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

<script>
    var myTextElement = document.getElementById('myText');
    setTimeout(function () {
        myTextElement.style.display = 'none';
    }, 3000);
</script>
<script>
    // Lấy tất cả các nút hoặc liên kết có class "delete-button"
    var deleteButtons = document.querySelectorAll('.delete-button');

    // Lặp qua từng nút hoặc liên kết và thêm sự kiện click
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Ngăn chặn hành động mặc định của liên kết (không chuyển hướng trang)
            event.preventDefault();

            // Sử dụng hộp thoại xác nhận
            var confirmation = confirm('Bạn có muốn xóa không?');

            // Nếu người dùng đồng ý xóa, chuyển hướng đến đường dẫn xóa
            if (confirmation) {
                window.location = button.getAttribute('href');
            }
        });
    });
</script>
<script>
    // Lấy tất cả các nút hoặc liên kết có class "delete-button"
    var editButtons = document.querySelectorAll('.edit-button');

    // Lặp qua từng nút hoặc liên kết và thêm sự kiện click
    editButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Ngăn chặn hành động mặc định của liên kết (không chuyển hướng trang)
            event.preventDefault();

            // Sử dụng hộp thoại xác nhận
            var confirmation = confirm('Warning!!!This Action will change a status and it wont be change anymore. Are you sure with this?');

            // Nếu người dùng đồng ý xóa, chuyển hướng đến đường dẫn xóa
            if (confirmation) {
                window.location = button.getAttribute('href');
            }
        });
    });
</script>




<!-- end common js -->


</body>
</html>
