@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}} | Register
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 mx-auto py-5 mt-5">
                <div class="card shadow card-half-transparent rounded-15px">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset('assets/images/logo.png')}}"
                                 class="rounded-circle shadow bg-white"
                                 width="150" height="150">
                        </div>
                        <h1 class="text-center mt-3">
                            Register
                        </h1>
                        <hr width="25%" align="center" class="mx-auto">

                        <form action="" method="POST" class="mt-5">
                            @csrf
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">Full Name</label>:
                                    <input type="text" class="form-control" name="full_name"
                                           value="{{old('full_name')}}">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">Password</label>:
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="col-md mt-md-0 mt-2">
                                    <label class="form-label" style="font-weight: bold;">Retype Password</label>:
                                    <input type="password" class="form-control" name="retype_password">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">Username</label>:
                                    <input type="text" class="form-control" name="username"
                                           value="{{old('username')}}">
                                </div>
                                <div class="col-md mt-md-0 mt-2">
                                    <label class="form-label" style="font-weight: bold;">Email</label>:
                                    <input type="text" class="form-control" name="email"
                                           value="{{old('email')}}">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">Gender</label>:
                                    <select name="gender" class="form-control">
                                        <option value="Male" {{old('gender') == "Male" ? "selected": ""}}>
                                            Male
                                        </option>
                                        <option value="Female" {{old('gender') == "Female" ? "selected": ""}}>
                                            Female
                                        </option>
                                        <option value="Other" {{old('gender') == "Other" ? "selected": ""}}>
                                            Other
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">Birth Date</label>:
                                    <input type="date" class="form-control" name="birth_date"
                                           value="{{old('birth_date')}}">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md mt-md-0 mt-2">
                                    <label class="form-label" style="font-weight: bold;">Phone Number</label>:
                                    <input type="text" class="form-control" name="phone_number"
                                           value="{{old('phone_number')}}">
                                </div>
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">Address</label>:
                                    <input type="text" class="form-control" name="address"
                                           value="{{old('address')}}">
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                            <div class="text-center mt-2">
                                Having an account? <a href="/login">Login</a>
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
