@extends('layout.master')
@section('content')
    <form method="post" action="{{route('grade.store')}}">
        <div class="card">
            <div class="card-body">

                <div class=""><h2 class="text-left mb-4">Create grade</h2></div>
                <table class="table table-striped " >

                    @csrf

                    <div class="row w-80">
                        <div class="col-lg-10 mx-auto">
                            <div class="auto-form-wrapper">
                                <div class="form-group">
                                    <label class="label">Grade Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Grade Name" name="grade_name">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>

        <button class="btn btn-inverse-success">Add</button>
    </form>
@endsection
