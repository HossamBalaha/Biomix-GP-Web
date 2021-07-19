@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}} | User Dashboard
@endsection

@section('body')
    @include('user.navbar')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="p-5 rounded bg-white shadow shadow-lg rounded-15px py-5">
                    <h1>Symptoms</h1>
                    <hr>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/user">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Symptoms</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 my-2 hvr-grow mx-auto">
                <div class="card rounded p-2 shadow rounded-15px">
                    <a href="/user/symptoms/start" class="a-no-link">
                        <div class="card-body">
                            <p class="card-title display-6 text-dark float-end">
                                <i class="fa fa-tasks"></i>
                            </p>
                            <p class="card-text font-size-20px text-dark align-middle my-1">
                                New Analysis
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-2 hvr-grow mx-auto">
                <div class="card rounded p-2 shadow rounded-15px">
                    <a href="/user/symptoms/latest-analyses" class="a-no-link">
                        <div class="card-body">
                            <p class="card-title display-6 text-dark float-end">
                                <i class="fa fa-virus"></i>
                            </p>
                            <p class="card-text font-size-20px text-dark align-middle my-1">
                                Latest Analyses
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
