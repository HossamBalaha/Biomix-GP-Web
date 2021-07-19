@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}} | User Profile
@endsection

@section('body')
    @include('user.navbar')

    <div class="container mb-5">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <img src="{{$data['user_info']['avatar']}}"
                     width="200" height="200" class="rounded-circle hvr-grow shadow shadow-lg border border-white"
                     alt="User Avatar">
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
                            Personal Information
                        </p>
                        <hr class="w-25 mx-auto" align="center">
                        <ul class="list-group mx-0 px-0">
                            <li class="list-group-item">
                                <span class="" style="font-weight: bold;">
                                    Full Name
                                </span>:
                                <span class="">{{$data['user_info']['full_name']}}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="" style="font-weight: bold;">
                                    Username
                                </span>:
                                <span class="">{{$data['user_info']['username']}}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="" style="font-weight: bold;">
                                    Email
                                </span>:
                                <span class="">{{$data['user_info']['email']}}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="" style="font-weight: bold;">
                                    Gender
                                </span>:
                                <span class="">{{$data['user_info']['gender']}}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="" style="font-weight: bold;">
                                    Date of Birth
                                </span>:
                                <span class="">{{$data['user_info']['birth_date']}}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="" style="font-weight: bold;">
                                    Phone Number
                                </span>:
                                <span class="">{{$data['user_info']['phone_number']}}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="" style="font-weight: bold;">
                                    Address
                                </span>:
                                <span class="">{{$data['user_info']['address']}}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="" style="font-weight: bold;">
                                    Account Role
                                </span>:
                                <span class="">{{$data['user_info']['role']}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
