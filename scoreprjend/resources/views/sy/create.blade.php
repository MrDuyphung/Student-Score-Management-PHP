@extends('layout.master')
@section('content')
    <form method="post" action="{{route('sy.store')}}">
        <div class="card">
            <div class="card-body">

                <div class=""><h2 class="text-left mb-4">Create School Year</h2></div>
                <table class="table table-striped " >

                    @csrf

                    <div class="row w-80">
                        <div class="col-lg-10 mx-auto">
                            <div class="auto-form-wrapper">
                                <div class="form-group">
                                    <label class="label">School Year Number</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="School Year Number" name="sy_number">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">School Year Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="School Year Name" name="sy_name">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>
            <button class="btn btn-outline-success">Add</button>
    </form>
@endsection
