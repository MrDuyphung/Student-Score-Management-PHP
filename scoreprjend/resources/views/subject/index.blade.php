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
                    <h1 class="card-title">Subject</h1>
                    <form method="GET" action="{{ route('subject.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by name, grade ..." name="search">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                <a class="btn btn-success btn-fw; menu-icon mdi mdi-creation" href="{{ route('subject.create') }}" class="btn btn-light">Add a subject</a>
                <table class="table table-striped">
                    <tr>
                        <th>ID Subject</th>
                        <th>Subject Name</th>
                        <th>Semester</th>
                        <th>Curriculum</th>
                        <th>Grade</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject->id }}</td>
                            <td>{{ $subject->subject_name }}</td>
                            <td>
                                @if($subject->semester == 1)
                                    Semester 1
                                @elseif($subject->semester == 2)
                                    Semester 2
                                @else
                                    {{ $subject->semester }}
                                @endif
                            </td>
                            <td>
                                @if($subject->text_book == 1)
                                    Textbook for grade 10
                                @elseif($subject->text_book == 2)
                                    Textbook for grade 11
                                @elseif($subject->text_book == 3)
                                    Textbook for grade 12
                                @else
                                    {{ $subject->text_book }}
                                @endif
                            </td>
                            <td>{{ $subject->grade_name }}</td>
                            <td>
                                <a class="btn btn-inverse-primary" href="{{ route('subject.edit', $subject->id) }}" class="btn btn-app">Edit</a>
                            </td>
                            <td>
                                <form method="post" action="{{ route('subject.destroy', $subject->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-inverse-danger" type="submit" onclick="return confirmDelete();">Delete</button>
                                </form>
                                <script>
                                    function confirmDelete() {
                                        return confirm('Do you want to delete?');
                                    }
                                </script>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
