@extends('layout.master')
@section('content')
    @if (session('error'))
        <div class="alert alert-danger" id="myText">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" id="myText">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-lg-12 grid-margin stretch-card">


        <div class="card">

            <div class="card-body">

                <div class="mb-3">
                    <h1 class="card-title">teacher</h1>
    <div class="card-body">
        <div class="mb-3">
            <form method="GET" action="{{ route('teacher.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by name, email, class ..." name="search">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="mb-3">
            <label for="per_page" class="form-label">Records per page:</label>
            <select class="form-select" id="per_page" name="per_page">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>

        <!-- Danh sách sinh viên -->

            <!-- Hiển thị thông tin sinh viên -->

            <!-- Hiển thị nút phân trang -->
            <div class="d-flex justify-content-lg-end">
                {{ $teachers->links() }}
            </div>
        </table>
    <a class="btn btn-success btn-fw; menu-icon mdi mdi-creation" href="{{ route('teacher.create') }}" >Add a teacher</a>
        <table class="table table-striped">
        <tr>
            <th>ID teacher</th>
            <th>teacher Name</th>
            <th>Email</th>
            <th>Phone</th>
{{--            <th>Password</th>--}}
            <th>grade</th>
            <th>Configure</th>
            <th>Destroy</th>
        </tr>
        @foreach($teachers as $teacher)
            <tr>
                <td>
                    {{$teacher->id}}
                </td>
                <td>
                    {{$teacher->teacher_name}}
                </td>
                <td>
                    {{$teacher->email}}
                </td>
                <td>
                    {{$teacher->phone}}
                </td>
{{--                <td>--}}
{{--                    {{$teacher->password}}--}}
{{--                </td>--}}
                <td>
                    {{$teacher->grade_name}}
                </td>
                <td>
                    <a href="{{route('teacher.edit', $teacher -> id )}}" class="btn btn-primary btn-fw">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{route('teacher.destroy', $teacher -> id )}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-fw"  type="submit" onclick="return confirmDelete();">Delete</button>
                    </form>
                    <script>
                        function confirmDelete() {
                            // Sử dụng hộp thoại xác nhận
                            return confirm('Do you want to delete?');
                        }
                    </script>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
