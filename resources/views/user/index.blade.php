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
                    <h1 class="text-center mb-3">User Dashboard</h1>
                    <p class="m-0 p-0 text-center">Welcome, <b>{{$data['user_info']['full_name']}}</b></p>
                    <hr width="25%" class="text-center mx-auto bg-dark" color="black">
                </div>
            </div>
        </div>

        <div class="row mt-5">
            @foreach($data['cards'] as $card)
                <div class="col-lg-4 col-md-6 my-2 hvr-bob mx-auto">
                    <div class="card rounded p-2 shadow rounded-15px py-3">
                        <a href="{{$card['url']}}" class="a-no-link">
                            <div class="card-body">
                                <p class="card-title display-6 text-dark float-end">
                                    <i class="{{$card['icon']}}"></i>
                                </p>
                                <p class="card-text font-size-20px text-dark text-dark align-middle my-1">
                                    {{$card['name']}}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    {{--<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.7.4/dist/tf.min.js"></script>--}}
    <script>
        jQuery(document).ready(function () {
            window.SaySentence("Hello and welcome to your dashboard. I am BIOMIX, your personal health care assistant.");
            window.SaySentence('You can turn on or off my next sound play by clicking on the robot icon in the bottom right corner.');
        });

        // let work = async () => {
        //     const URI = `http://localhost/assets/tfjs/t2/model.json`;
        //     const model = await tf.loadLayersModel(URI);
        //     // 'http://localhost/assets/tfjs/t2/model.json'
        //     // const model = await tf.loadLayersModel('https://storage.googleapis.com/tfjs-models/tfjs/iris_v1/model.json');
        //     // model.summary();
        // };
        // work();
    </script>
@endsection
