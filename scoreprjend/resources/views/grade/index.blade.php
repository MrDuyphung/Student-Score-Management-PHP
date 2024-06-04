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
    <div class="card">
        <h1 class="dropdown-item-title; d-flex justify-content-center" >grade Management</h1>
        <div class="card-body">
            <div class="mb-3">
    <form method="GET" action="{{ route('grade.index') }}">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by..." name="search">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <a class="btn btn-success btn-fw; menu-icon mdi mdi-creation" href="{{route('grade.create')}}">Add</a>
                <table class="table table-striped " >
        <tr>
            <th>ID</th>
            <th>Grade Name</th>
            <th>Teacher in charge</th>
            <th>Subject</th>
            <th>Class</th>
            <th>Total Students</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach($grades as $grade)
            <tr>
                <td>
                    {{$grade->id}}
                </td>
                <td>
                    {{$grade->grade_name}}
                </td>
                <td >{{ $grade->getNumberOfteacher() }}</td>
                <td>{{ $grade->getNumberOfSubject() }}</td>
                <td>{{ $grade->getNumberOfClass() }}</td>
                <td>{{ $grade->getNumberOfStudent() }}</td>

                <td>
                    <a class="btn btn-info" href="{{ route('grade.checkClass', $grade->id) }}">Check Class</a>
                </td>
                <td>
                    <a class="btn btn-inverse-primary" href="{{ route('grade.edit', $grade-> id) }}">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{ route('grade.destroy', $grade->id) }}">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-inverse-danger" type="submit" onclick="return confirmDelete();">Delete</button>
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
