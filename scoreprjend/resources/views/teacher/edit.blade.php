@extends('layout.master')
@section('content')
    <form method="post" action="{{route('teacher.update', $id)}}">
        @csrf
        @method('PUT')
        @foreach($teachers as $teacher)
            <div class="card">
                <div class="card-body">

                    <div class=""><h2 class="text-left mb-4">Edit teacher</h2></div>
                    <table class="table table-striped " >
                        <div class="row w-80">
                            <div class="col-lg-10 mx-auto">
                                <div class="auto-form-wrapper">
                                    <div class="form-group">
                                        <label class="label">teacher Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="teacher Name" value="{{$teacher->teacher_name}}" name="teacher_name">
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label">Email</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{$teacher->email}}">
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label">Phone</label>
                                        <div class="input-group">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Numbers" value="{{$teacher->phone}}">
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password" value="{{$teacher->password}}">
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
            grade<br> <select name="grade_id" class="input-group">
                @foreach($grades as $grade)
                    <option value="{{$grade-> id}}"
                    @if($grade->id == $teacher->grade_id)
                        {{'selected'}}
                        @endif
                    >
                        {{$grade->grade_name}}
                    </option>
                @endforeach
            </select><br>
                                </div>
        @endforeach
        <button class="btn btn-outline-info">Update</button>
    </form>
@endsection
