@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}} | Login
@endsection

@section('body')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto py-5 mt-5">
                <div class="card shadow shadow-lg card-half-transparent rounded-15px">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset('assets/images/logo.png')}}"
                                 class="rounded-circle shadow bg-white"
                                 width="150" height="150">
                        </div>
                        <h1 class="text-center mt-3">
                            Login
                        </h1>
                        <hr width="25%" align="center" class="mx-auto">

                        <form action="" method="POST" class="mt-5">
                            @csrf
                            <div class="form-group mb-2">
                                <div class="col-12">
                                    <input placeholder="Username" value="{{old('username')}}" name="username"
                                           class="form-control rounded shadow text-center">
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <div class="col-12">
                                    <input placeholder="Password" value="{{old('password')}}" name="password"
                                           type="password" class="form-control rounded shadow text-center">
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                            <div class="text-center mt-2">
                                Don't have an account? <a href="/register">Register Now</a>
                                <br>
                                Return <a href="/">Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
