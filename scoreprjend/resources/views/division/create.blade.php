@extends('layout.master')
@section('content')
    <form method="post" action="{{route('division.store')}}">
        <div class="card">
            <div class="card-body">

                <div class=""><h2 class="text-left mb-4">Create Division</h2></div>
                <table class="table table-striped " >

                    @csrf

                    <div class="row w-80">
                        <div class="col-lg-10 mx-auto">
                            <div class="auto-form-wrapper">
{{--                                <div class="form-group">--}}
{{--                                    <label class="label">Division Name</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" class="form-control" placeholder="Division Name" name="division_name">--}}
{{--                                        <div class="input-group-append">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
        <div class="form-group">
            <label class="label">Semester</label>
            <div>
                <select name="semester" class="input-group">
                    <option value="0">Semester 1</option>
                    <option value="1">Semester 2</option>
                    <option value="2">Extra Semester</option>
                </select>
            </div>
        </div>
                                <div class="form-group">
                                    <label class="label">Class</label>
                                    <div>
                                        <select name="class_id" class="input-group">
                                            @foreach($classes as $class)
                                                <option value="{{$class-> id}}">
                                                    {{$class->class_name}}_{{$class->sy_name}}___({{$class->grade_name}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">teacher</label>
                                    <div>
         <select name="teacher_id" class="input-group">
            @foreach($teachers as $teacher)
                <option value="{{$teacher-> id}}">
                    {{$teacher->teacher_name}}___({{$teacher->grade_name}})
                </option>
            @endforeach
        </select>
                                    </div>
                                </div>
{{--        grade: <select name="grade_id" disabled>--}}
{{--            @foreach($grades as $grade)--}}
{{--                <option value="{{$grade-> id}}"--}}
{{--                @foreach($teachers as $teacher)--}}
{{--                @if($grade->id == $teacher->grade_id)--}}
{{--                    {{'selected'}}--}}
{{--                    @endif--}}


{{--                >--}}
{{--                    {{$grade->grade_name}}--}}

{{--                </option>--}}
{{--            @endforeach--}}
{{--                @endforeach--}}
{{--        </select><br>--}}
                                <div class="form-group">
                                    <label class="label">Subject</label>
                                    <div>
        <select name="subject_id" class="input-group">
            @foreach($subjects as $subject)
                <option value="{{$subject-> id }}">
                    {{$subject->subject_name}}___({{$subject->grade_name}})
                </option>
            @endforeach
        </select>
                                    </div>
                                </div>


{{--        Admin: <select name="admin_id">--}}
{{--            @foreach($admins as $admin)--}}
{{--                <option value="{{$admin-> id}}">--}}
{{--                    {{$admin->username}}--}}
{{--                </option>--}}
{{--            @endforeach--}}
{{--        </select><br>--}}
        <button class="btn btn-outline-success">Add</button>
    </form>
@endsection
