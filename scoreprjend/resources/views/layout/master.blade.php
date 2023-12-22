<!DOCTYPE html>
<html>
<head>
  <title>Student Record Management</title>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


{{--    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">--}}
  <!-- common css -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <!-- end common css -->


</head>
<body data-base-url="{{url('/')}}">

  <div class="container-scroller" id="app">
    @include('layout.header')
    <div class="container-fluid page-body-wrapper">
      @include('layout.sidebar')
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        @include('layout.footer')
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
  <script src="{{asset('assets/js/chart.js')}}"></script>
  <script src="{{asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('assets/js/misc.js')}}"></script>
  <script src="{{asset('assets/js/settings.js')}}"></script>
  <script src="{{asset('assets/js/todolist.js')}}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>--}}
{{--  <script src="{{ asset('js/custom.js') }}"></script>--}}


  <script>
      $(document).ready(function() {
          $('#classSelect').change(function() {
              var classId = $(this).val();
              var url = '/get-students-by-class/' + classId;

              $.ajax({
                  url: url,
                  type: 'GET',
                  success: function(data) {
                      var studentList = $('#studentList');
                      studentList.empty();

                      if (data.length > 0) {
                          $.each(data, function(index, student) {
                              studentList.append('<div>' + student.name + '</div>');
                          });
                      } else {
                          studentList.append('<div>No students found.</div>');
                      }
                  },
                  error: function(error) {
                      console.error(error);
                  }
              });
          });
      });
  </script>
  <script>
      $(document).ready(function(){
          $('#per_page').on('change', function(){
              var perPage = $(this).val();
              var currentUrl = window.location.href;
              // Kiểm tra xem URL đã chứa tham số per_page hay chưa
              if (currentUrl.includes('per_page=')) {
                  // Nếu đã chứa, thay thế giá trị cũ bằng giá trị mới
                  currentUrl = currentUrl.replace(/per_page=\d+/, 'per_page=' + perPage);
              } else {
                  // Nếu chưa chứa, thêm tham số vào URL
                  currentUrl += (currentUrl.includes('?') ? '&' : '?') + 'per_page=' + perPage;
              }
              // Chuyển hướng đến URL mới
              window.location.href = currentUrl;
          });
      });
  </script>
  <script>
      var myTextElement = document.getElementById('myText');
      setTimeout(function () {
          myTextElement.style.display = 'none';
      }, 5000);
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
  <!-- end common js -->

  <script>
      // Lấy các phần tử cần thiết
      const modeToggle = document.getElementById('modeToggle');
      const modeIcon = document.getElementById('modeIcon');
      const body = document.body;

      // Định nghĩa biến để theo dõi trạng thái chế độ
      let isDarkMode = false;

      // Xử lý sự kiện khi nút chuyển đổi được nhấp vào
      modeToggle.addEventListener('click', function() {
          isDarkMode = !isDarkMode; // Đảo ngược trạng thái chế độ
          if (isDarkMode) {
              // Nếu là chế độ ban đêm
              body.classList.add('dark-mode'); // Thêm lớp CSS cho chế độ ban đêm
              modeIcon.className = 'mdi mdi-weather-sunset'; // Thay đổi biểu tượng
          } else {
              // Nếu là chế độ Light
              body.classList.remove('dark-mode'); // Loại bỏ lớp CSS chế độ ban đêm
              modeIcon.className = 'mdi mdi-weather-sunny'; // Thay đổi biểu tượng
          }
      });
  </script>
</body>
</html>
