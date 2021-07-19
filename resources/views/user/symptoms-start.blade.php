@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}} | User Dashboard
@endsection

@section('body')
    @include('user.navbar')

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="p-5 rounded bg-white shadow shadow-lg rounded-15px">
                    <h1>Start New Symptoms Analysis</h1>
                    <hr>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/user">Home</a></li>
                            <li class="breadcrumb-item"><a href="/user/symptoms">Symptoms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Symptoms Analysis</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card shadow shadow-lg rounded-15px">
                    <div class="card-body py-4">
                        <p class="text-center font-size-20px m-0 p-0">
                            To Start the Analysis
                        </p>
                        <hr width="20%" align="center" class="mx-auto">
                        <p class="text-center display-6 m-0 p-0">
                            Select Your Symptoms
                        </p>
                        <hr>

                        <div class="row mt-3" style="max-height: 500px; overflow-x: hidden; overflow-y: scroll;">
                            @foreach($data['symptoms'] as $k => $symptom)
                                <div class="col-lg-3 col-md-4 col-sm-6 my-2 hvr-grow">
                                    <div class="card rounded shadow shadow-lg rounded-12px symptom" data-k="{{$k}}">
                                        <div class="card-body">
                                            <button class="btn btn-sm btn-info mt-1 align-middle float-end speak rounded-10px">
                                                <i class="fa fa-volume-up text-white"></i>
                                            </button>
                                            <p class="card-text text-dark text-center text-capitalize align-middle my-1">
                                                {{$symptom}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6 col-lg-4 text-center mx-auto">
                                <form action="" method="POST" class="d-inline" id="startAnalysisForm">
                                    @csrf
                                    <input type="hidden" value="" id="selectedSymptoms" name="k">
                                    <button class="btn btn-success hvr-pulse w-auto py-2" id="startAnalysis">
                                        Start Analysis
                                    </button>
                                </form>
                                <button class="mx-2 btn btn-secondary w-auto py-2" id="removeAllSelections">
                                    Remove All Selections
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/compiled/app.symptoms-start.js')}}"></script>
    <script>
        jQuery(document).ready(function () {
            window.SaySentence('Please, select your symptoms from the cards shown below.');
            window.SaySentence('There are {{count($data['symptoms'])}} symptoms.');
        });
    </script>
@endsection
