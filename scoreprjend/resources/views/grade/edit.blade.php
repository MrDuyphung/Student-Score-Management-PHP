@extends('layout.master')
@section('content')
    <form method="post" action="">
        @method('PUT')
        @csrf
        @foreach($grades as $grade)
            <div class="card">
                <div class="card-body">

                    <div class=""><h2 class="text-left mb-4">Edit grade</h2></div>
                    <table class="table table-striped " >
                        <div class="row w-80">
                            <div class="col-lg-10 mx-auto">
                                <div class="auto-form-wrapper">
                                    <div class="form-group">
                                        <label class="label">Grade Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="grade Name" value="{{ $grade->grade_name }}" name="grade_name">
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>

        @endforeach
        <button class="btn btn-outline-info ">Update</button>
    </form>
@endsection
