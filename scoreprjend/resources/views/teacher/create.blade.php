@extends('layout.master')
@section('content')
    <form method="post" action="{{route('teacher.store')}}">
        <div class="card">
            <div class="card-body">

                <div class=""><h2 class="text-left mb-4">Create teacher</h2></div>
                <table class="table table-striped " >

                    @csrf

                    <div class="row w-80">
                        <div class="col-lg-10 mx-auto">
                            <div class="auto-form-wrapper">
                                <div class="form-group">
                                    <label class="label">teacher Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="teacher Name" name="teacher_name">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Email" name="email">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Phone</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Phone Numbers" name="phone">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
        grade<br> <select name="grade_id" class="input-group">
            @foreach($grades as $grade)
                <option value="{{$grade-> id}}">
                    {{$grade->grade_name}}
                </option>
            @endforeach
        </select><br>
                                </div>
        <button class="btn btn-outline-success">Add</button>
    </form>
@endsection
