@extends('layout.masterLecturer')
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
    <!-- Form lọc dữ liệu -->
{{--    <form method="get" action="{{ route('transdetail.index') }}" class="form-inline">--}}
{{--        <div class="form-group mr-3">--}}
{{--            <label for="exam_times">Exam Times:</label>--}}
{{--            <select name="exam_times" class="input-group">--}}
{{--                <option value="">All</option>--}}
{{--                <option value="0" {{ request('exam_times') === '0' ? 'selected' : '' }}>1 Times</option>--}}
{{--                <option value="1" {{ request('exam_times') === '1' ? 'selected' : '' }}>2 Times</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="form-group mr-3">--}}
{{--            <label for="class_id">Class:</label>--}}
{{--            <select name="class_id" class="input-group">--}}
{{--                <option value="">All</option>--}}
{{--                @php--}}
{{--                    $selectedClassIds = [];--}}
{{--                @endphp--}}
{{--                @foreach($lecturerDivisions as $division)--}}
{{--                    @if (!in_array($division->class->id, $selectedClassIds))--}}
{{--                        <option value="{{ $division->class->id }}" {{ request('class_id') === $division->class->id ? 'selected' : '' }}>--}}
{{--                            {{ $division->class->class_name }}_{{ $division->class->school_year->sy_name }}--}}
{{--                        </option>--}}
{{--                        @php--}}
{{--                            $selectedClassIds[] = $division->class->id;--}}
{{--                        @endphp--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="form-group mr-3">--}}
{{--            <label for="subject_id">Subject:</label>--}}
{{--            <select name="subject_id" class="input-group">--}}
{{--                <option value="">All</option>--}}
{{--                @php--}}
{{--                    $selectedSubjectIds = [];--}}
{{--                @endphp--}}
{{--                @foreach($lecturerDivisions as $division)--}}
{{--                    @if (!in_array($division->subject->id, $selectedSubjectIds))--}}
{{--                        <option value="{{ $division->subject->id }}" {{ request('subject_id') === $division->subject->id ? 'selected' : '' }}>--}}
{{--                            {{ $division->subject->subject_name }}--}}
{{--                        </option>--}}
{{--                        @php--}}
{{--                            $selectedSubjectIds[] = $division->subject->id;--}}
{{--                        @endphp--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="form-group mr-3">--}}
{{--            <label for="semester">Semester:</label>--}}
{{--            <select name="semester" class="input-group">--}}
{{--                <option value="">All</option>--}}
{{--                <option value="0" {{ request('semester') === '0' ? 'selected' : '' }}>Semester 1</option>--}}
{{--                <option value="1" {{ request('semester') === '1' ? 'selected' : '' }}>Semester 2</option>--}}
{{--                <option value="2" {{ request('semester') === '2' ? 'selected' : '' }}>Extra Semester</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-primary">Apply Filters</button>--}}
{{--    </form>--}}


    <div class="col-lg-15 grid-margin stretch-card" >

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Transcript Detail</h1>
{{--                <a class="btn btn-success btn-fw; menu-icon mdi mdi-creation  " href="{{route('transdetail.create')}}">Add Point</a>--}}
                <table class="table table-striped " >

        <tr>
            <th>Transcript</th>
            <th>Student_Name</th>
            <th>Class</th>
            <th>Specialized</th>
            <th>Subject</th>
            <th>Test time</th>
            <th>Semester</th>
            <th>Note</th>
            <th>Score</th>
            <th>Rates</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($transcript_details as $transcript_detail)
            <tr>
                <td>
                    {{$transcript_detail->transcript->transcript_name}}
                </td>
                <td>
                    {{$transcript_detail->student->student_name}}
                </td>
                <td>
                    {{$transcript_detail->transcript->division->class->class_name}}_{{$transcript_detail->transcript->division->class->school_year->sy_name}}
                </td>
                </td>
                <td>
                    {{$transcript_detail->specialized_name}}
                </td>

                <td>
                    {{$transcript_detail->transcript->division->subject->subject_name}}
                </td>
                <td>
                    @if($transcript_detail -> exam_times == 0)
                        <div class="badge badge-success">1 times</div>
                    @elseif($transcript_detail -> exam_times == 1)
                        <div class="badge badge-primary">2 times</div>
                    @elseif($transcript_detail -> exam_times == 2)
                        <div class="badge badge-danger">Banned</div>
                    @elseif($transcript_detail -> exam_times == 3)
                        <div class="badge badge-warning">Exam Skipped</div>
                    @endif
                </td>

                <td>
                    @if($transcript_detail -> semester == 0)
                    <div class="badge badge-primary">Semester 1</div>
                    @elseif($transcript_detail -> semester == 1)
                    <div class="badge badge-info">Semester 2</div>
                    @elseif($transcript_detail -> semester == 2)
                    <div class="badge badge-warning">Extra Semester</div>
                    @endif
                </td>
                <td>
                    @if($transcript_detail -> note == 1)
                        <div class="badge badge-info">Tested</div>
                    @elseif($transcript_detail -> note == 2)
                        <div class="badge badge-danger">Banned</div>
                    @elseif($transcript_detail -> note == 3)
                        <div class="badge badge-warning">Exam Skipped</div>
                    @endif
                </td>
                <td @if($transcript_detail -> score <= 5) class="text-danger"
                @elseif($transcript_detail -> score >= 5.01) class="text-success"
                    @endif>
                    {{$transcript_detail->score ?? 'None'}}


                </td>
                <td @if($transcript_detail -> score < 5)
                    {{$transcript_detail->score ?? 'None'}}
                    <div class="text-danger "> Fail <i class="mdi mdi-arrow-down"></i> </div>
                    @elseif($transcript_detail -> score >= 5.01)
                    <div class="text-success"> Pass <i class="mdi mdi-arrow-up"></i> </div>
                    @endif



                </td>
                <td>
                    <a href="{{route('transdetail.edit', $transcript_detail -> id )}}" class="mdi mdi-account-edit badge badge-primary">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{ route('transdetail.destroy', $transcript_detail->id) }}" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="mdi mdi-delete badge badge-danger" type="submit" onclick="return confirmDelete();">Delete</button>
                    </form>
                </td>
            </tr>
                    @endforeach
                </table>

                    <script>
                        function confirmDelete() {
                            // Sử dụng hộp thoại xác nhận
                            return confirm('Do you want to delete?');
                        }
                    </script>

@endsection
