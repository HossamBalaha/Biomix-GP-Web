@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}} | User Settings
@endsection

@section('body')
    @include('user.navbar')

    <div class="container mb-5">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5">
                <div class="col-auto mx-auto text-center">
                    <div class="avatar-wrapper hvr-grow">
                        <label for="avatar" class="avatar">
                            <i class="fa fa-image fa-5x"></i>
                        </label>
                        <img src="{{$data['user_info']['avatar']}}" width="200" height="200" alt="User Avatar"
                             class="rounded-circle shadow shadow-lg border border-white userAvatar">
                    </div>
                    <input type="file" class="d-none" id="avatar" name="avatar">
                    <p class="text-center my-4 p-0 display-5 p-4">
                        <span class="bg-white p-2 px-4 rounded shadow shadow-lg rounded-15px" id="writer">
                            {{$data['user_info']['full_name']}}
                        </span>
                    </p>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-half-transparent shadow rounded-15px">
                        <div class="card-body">
                            <p class="text-center font-size-25px m-0 p-0 h5">
                                Updating Personal Information
                            </p>
                            <hr class="w-25 mx-auto" align="center">

                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">
                                        Full Name
                                    </label>:
                                    <input type="text" class="form-control" name="full_name"
                                           value="{{$data['user_info']['full_name']}}">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md mt-md-0 mt-2">
                                    <label class="form-label" style="font-weight: bold;">
                                        Email
                                    </label>:
                                    <input type="text" class="form-control" name="email"
                                           value="{{$data['user_info']['email']}}">
                                </div>
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">
                                        Gender
                                    </label>:
                                    <select name="gender" class="form-control">
                                        <option
                                            value="Male" {{$data['user_info']['gender'] == "Male" ? "selected": ""}}>
                                            Male
                                        </option>
                                        <option
                                            value="Female" {{$data['user_info']['gender'] == "Female" ? "selected": ""}}>
                                            Female
                                        </option>
                                        <option
                                            value="Other" {{$data['user_info']['gender'] == "Other" ? "selected": ""}}>
                                            Other
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">
                                        Date of Birth
                                    </label>:
                                    <input type="date" class="form-control" name="birth_date"
                                           value="{{$data['user_info']['birth_date']}}">
                                </div>
                                <div class="col-md mt-md-0 mt-2">
                                    <label class="form-label" style="font-weight: bold;">
                                        Phone Number
                                    </label>:
                                    <input type="text" class="form-control" name="phone_number"
                                           value="{{$data['user_info']['phone_number']}}">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">
                                        Address
                                    </label>:
                                    <input type="text" class="form-control" name="address"
                                           value="{{$data['user_info']['address']}}">
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">
                                    Update Information
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="/user/change-password" method="POST" class="mt-4">
            @csrf
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-half-transparent shadow rounded-15px">
                        <div class="card-body">
                            <p class="text-center font-size-25px m-0 p-0 h5">
                                Changing Password
                            </p>
                            <hr class="w-25 mx-auto" align="center">

                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label" style="font-weight: bold;">
                                        New Password
                                    </label>:
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="col-md mt-md-0 mt-2">
                                    <label class="form-label" style="font-weight: bold;">
                                        Retype New Password
                                    </label>:
                                    <input type="password" class="form-control" name="retype_password">
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
