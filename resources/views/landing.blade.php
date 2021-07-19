@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}}
@endsection

@section('styles')
    <style>
        #bg {
            background-image: none !important;
            background-color: rgba(0, 0, 0, 0.15) !important;
            filter: blur(2px);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            width: 130%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: -99;
        }

        .header {
            min-height: auto;
            background: #15141a url('{{asset('assets/images/landing-top-bg.jpg')}}') no-repeat 0 0;
            background-size: cover;
        }

        .bg-other {
            background-color: rgba(0, 0, 0, 0.05) !important;
        }
    </style>
@endsection

@section('body')
    <header class="header shadow pt-5" id="home">
        <nav
            class="navbar navbar-expand-lg navbar-dark bg-transparent mb-5 p-4 fixed-top shadow shadow-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('assets/images/logo.png')}}"
                         width="32" height="32" class="rounded-circle shadow"
                         alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold" href="#home">
                                Home
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold" href="#features">
                                Features
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold" href="#supervisors">
                                Supervisors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold" href="#team">
                                Team Members
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container py-5">
            <div class="row py-5">
                <div class="col-md-6 mb-5">
                    <h5 class="text-primary">
                        Graduation Project 2020-2021
                    </h5>

                    <h1 class="text-white display-2" id="project-title">
                        {{env('PROJECT_TITLE')}}
                    </h1>

                    <p class="text-white">
                        {{\App\BIOMIX::$PROJECT_SUMMARY}}
                    </p>

                    <div class="mt-4">
                        <a href="/register" class="btn btn-success mx-1 px-4 hvr-pulse">Join Us</a>
                        <a href="/login"
                           class="a-no-link btn btn-default bg-transparent text-white mx-1">Login</a>
                    </div>
                </div>
                {{--<div class="col-md-6">--}}
                {{--<div class="text-center">--}}
                {{--<img src="{{asset('assets/images/jumbotron-image.png')}}" width="400" alt="">--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </header>

    <section class="py-5" id="features">
        <div class="container py-5">
            <header class="section-head">
                <h5 class="text-center text-uppercase text-primary font-weight-bold">Overview</h5>
                <h2 class="text-center mt-3 font-weight-bold display-5">Project Features</h2>
                <hr class="mx-auto mb-0" align="center" width="25%">
            </header>

            <div class="py-5">
                <div class="row">
                    @foreach(\App\BIOMIX::$PROJECT_FEATURES as $feature)
                        <div class="col-md-6 col-lg-3 mt-3 mx-auto">
                            <div class="card shadow shadow-lg hvr-grow rounded-15px wow zoomIn"
                                 data-wow-iteration="1"
                                 data-wow-delay="0.1s">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="border rounded-circle p-5 text-primary shadow fa-3x {{$feature['icon']}}"></i>
                                    </div>
                                    <h3 class="text-center mt-4">{{$feature['name']}}</h3>
                                    <div class="text-center mt-3">
                                        <p>
                                            {{$feature['description']}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-other" id="supervisors">
        <div class="container pt-5">
            <header class="section-head">
                <h2 class="text-center mt-3 font-weight-bold display-5">Supervisors</h2>
                <hr class="mx-auto mb-0" align="center" width="25%">
            </header>

            <div class="py-5">
                <div class="row text-center align-middle">
                    @foreach(\App\BIOMIX::getSupervisors() as $member)
                        <div class="col-md-6 col-lg-4 mt-3 mx-auto">
                            <div class="item card shadow shadow-lg hvr-grow rounded-15px">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{$member['avatar']}}"
                                             class="border rounded-circle shadow shadow-lg"
                                             width="150" height="150"
                                             alt="{{$member['name']}} Avatar">
                                    </div>
                                    <h4 class="text-center mt-4">
                                        {{$member['title']}}
                                    </h4>
                                    <h3 class="text-center mt-2">
                                        {{$member['name']}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="team">
        <div class="container pt-5">
            <header class="section-head">
                <h5 class="text-center text-uppercase text-primary font-weight-bold">Team Members</h5>
                <h2 class="text-center mt-3 font-weight-bold display-5">The One-hand Team Members</h2>
                <hr class="mx-auto mb-0" align="center" width="25%">
            </header>

            <div class="py-5">
                <div class="row text-center align-middle">
                    <div class="col-12">
                        <div class="owl-carousel owl-theme">
                            @foreach(\App\BIOMIX::getTeamMembers() as $member)
                                <div class="item card shadow shadow-lg rounded-15px">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{$member['avatar']}}"
                                                 class="border rounded-circle shadow shadow-lg"
                                                 width="100" height="225"
                                                 alt="{{$member['name']}} Avatar">
                                        </div>
                                        <h3 class="text-center h5 mt-4">
                                            {{$member['name']}}
                                        </h3>
                                        <div class="text-center mt-3">
                                            <p>
                                                {{$member['description']}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="bg-dark">
        <div class="container py-5">
            <div class="row mt-4">
                <div class="col-12 col-md-6">
                    <p class="m-0 text-white font-weight-bold h5">
                        Quick Links
                    </p>
                    <hr class="color-white border-white bg-white" width="50%">
                    <ul class="list-unstyled m-0 p-0">
                        <li class="">
                            <a class="text-white a-no-link" href="/login">
                                <i class="fa fa-link"></i>
                                Login
                            </a>
                        </li>
                        <li class="mt-2">
                            <a class="text-white a-no-link" href="/register">
                                <i class="fa fa-link"></i>
                                Register
                            </a>
                        </li>
                        <li class="mt-2">
                            <a class="text-white a-no-link" href="#features">
                                <i class="fa fa-link"></i>
                                Features
                            </a>
                        </li>
                        <li class="mt-2">
                            <a class="text-white a-no-link" href="#supervisors">
                                <i class="fa fa-link"></i>
                                Supervisors
                            </a>
                        </li>
                        <li class="mt-2">
                            <a class="text-white a-no-link" href="#team">
                                <i class="fa fa-link"></i>
                                Team Members
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <p class="m-0 text-white font-weight-bold h5">
                        Contact Us
                    </p>
                    <hr class="color-white border-white bg-white" width="50%">
                    <ul class="list-unstyled m-0 p-0">
                        <li class="">
                            <p class="m-0 text-white">
                                <i class="fa fa-mobile-alt"></i>
                                (000) 000-000-0000
                            </p>
                        </li>
                        <li class="mt-2">
                            <p class="m-0 text-white">
                                <i class="fa fa-fax"></i>
                                (000) 000-000-0000
                            </p>
                        </li>
                        <li class="mt-2">
                            <p class="m-0 text-white">
                                <i class="fa fa-at"></i>
                                email@emai.email
                            </p>
                        </li>
                        <li class="mt-2">
                            <p class="m-0 text-white">
                                <i class="fa fa-address-book"></i>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, praesentium.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function () {
            new Typewriter('#project-title', {
                strings: jQuery('#project-title').text().trim(),
                autoStart: true,
            }).callFunction(() => {
                jQuery('#project-title').find('.Typewriter__cursor').remove();
            });

            if (jQuery(window).scrollTop() <= 50) {
                jQuery('nav.navbar').removeClass('bg-dark').addClass('bg-transparent')
                    .removeClass('shadow').removeClass('shadow-lg');
            } else {
                jQuery('nav.navbar').addClass('bg-dark').removeClass('bg-transparent')
                    .addClass('shadow').addClass('shadow-lg');
            }

            jQuery(window).scroll(function () {
                if (jQuery(this).scrollTop() <= 50) {
                    jQuery('nav.navbar').removeClass('bg-dark').addClass('bg-transparent')
                        .removeClass('shadow').removeClass('shadow-lg');
                } else {
                    jQuery('nav.navbar').addClass('bg-dark').removeClass('bg-transparent')
                        .addClass('shadow').addClass('shadow-lg');
                }
            });
        });
    </script>
@endsection
