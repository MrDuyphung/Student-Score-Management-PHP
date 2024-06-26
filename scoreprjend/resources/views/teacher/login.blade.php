{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Teacher Login</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<h3> Login as Teacher </h3>--}}
{{--        <form action="{{ route('teacher.loginProcess') }}" method="post">--}}
{{--            @csrf--}}
{{--        Email: <input type="email" name="email"><br>--}}
{{--            Password: <input type="password" name="password"><br>--}}
{{--            <button>Login</button>--}}
{{--        </form>--}}
{{--</body>--}}
{{--</html>--}}
@extends('layout.master-mini')
@section('content')
    <div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/register.jpg') }}); background-size: cover;">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="auto-form-wrapper">
                    <form action="{{ route('teacher.loginProcess') }}" method="post">
@csrf
                        <div class="form-group" >

                            <label class="label">Email</label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="*********">
                                <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary submit-btn btn-block">Login as teacher</button>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="form-check form-check-flat mt-0">
{{--                                <label class="form-check-label">--}}
{{--                                    <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>--}}
                            </div>
                            <a href="{{ route('teacher.forgotPasswords') }}" class="text-small forgot-password text-black">Forgot Password</a>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <button class="btn btn-block g-login">--}}
{{--                                <img class="mr-3" src="{{ url('assets/images/file-icons/icon-google.svg') }}" alt="">Log in with Google</button>--}}
{{--                        </div>--}}
{{--                        <div class="text-block text-center my-3">--}}
{{--                            <span class="text-small font-weight-semibold">Not a member ?</span>--}}
{{--                            <a href="{{ url('/user-pages/register') }}" class="text-black text-small">Create new account</a>--}}
{{--                        </div>--}}
                    </form>
                </div>
                <ul class="auth-footer">
                    <li>
                        <a href="#">Conditions</a>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                    <li>
                        <a href="#">Terms</a>
                    </li>
                </ul>
                <p class="footer-text text-center">Copyright © 2023 Bootstrapdash. All rights reserved.</p>
            </div>
        </div>
    </div>

@endsection
