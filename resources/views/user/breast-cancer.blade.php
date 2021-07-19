@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}} | Sensors and Readings
@endsection

@section('body')
    @include('user.navbar')

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="p-5 rounded bg-white shadow shadow-lg rounded-15px">
                    <h1>Breast Cancer</h1>
                    <hr>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/user">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Breast Cancer</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow shadow-lg rounded-15px py-5">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset('assets/images/bc.jpg')}}" width="100" height="100"
                                 class="rounded-circle" alt="">
                        </div>
                        <hr width="10%" class="text-center mx-auto">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-6 mx-auto">
                                    <div class="text-center">
                                        <label for="bcImage" class="form-label text-center mx-auto font-weight-bold">
                                            Upload the Required Image
                                        </label>
                                    </div>
                                    <input class="form-control" type="file" name="bcImage" id="bcImage">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                        </form>
                        <hr width="80%" class="text-center mx-auto">
                        @if(\Illuminate\Support\Facades\Session::has('result'))
                            <div class="mt-5">
                                <p class="font-size-20px text-center">
                                    The uploaded image is
                                </p>
                                <h1 class="font-weight-bold text-center">
                                    {{\Illuminate\Support\Facades\Session::get('result')}}
                                </h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        {{--        @if(count($data['sensors']) > 0)--}}
        {{--            <div class="row mt-3">--}}
        {{--                <div class="col-12">--}}
        {{--                    <div class="card shadow shadow-lg rounded-15px">--}}
        {{--                        <div class="card-body py-4">--}}
        {{--                            <table class="table table-bordered table-hover table-striped" width="100%">--}}
        {{--                                <thead>--}}
        {{--                                <tr class="text-center">--}}
        {{--                                    <th class="align-middle">#</th>--}}
        {{--                                    <th class="align-middle">Sensor</th>--}}
        {{--                                    <th class="align-middle">Description</th>--}}
        {{--                                    <th class="align-middle">Created At</th>--}}
        {{--                                    <th data-orderable="false" class="align-middle">Options</th>--}}
        {{--                                </tr>--}}
        {{--                                </thead>--}}
        {{--                                <tbody>--}}
        {{--                                @foreach($data["sensors"] as $k => $record)--}}
        {{--                                    <tr class="text-center">--}}
        {{--                                        <td class="align-middle" style="white-space: nowrap;">{{$k+1}}</td>--}}
        {{--                                        <td class="align-middle text-wrap">--}}
        {{--                                            {{$record["name"]}}--}}
        {{--                                        </td>--}}
        {{--                                        <td class="align-middle text-wrap">--}}
        {{--                                            {{$record["description"]}}--}}
        {{--                                        </td>--}}
        {{--                                        <td class="align-middle" style="white-space: nowrap;">--}}
        {{--                                            {{$record["created_at"]}}--}}
        {{--                                        </td>--}}
        {{--                                        <td class="align-middle text-center" style="white-space: nowrap;">--}}
        {{--                                            <button class="btn btn-primary btn-sm mx-1"--}}
        {{--                                                    data-bs-target="#chartModal-{{$k+1}}"--}}
        {{--                                                    data-bs-toggle="modal">--}}
        {{--                                                <i class="fa fa-chart-line text-white"></i>--}}
        {{--                                            </button>--}}

        {{--                                            <div class="modal fade" id="chartModal-{{$k+1}}" tabindex="-1"--}}
        {{--                                                 data-wow-iteration="1"--}}
        {{--                                                 aria-labelledby="chartModalLabel-{{$k+1}}" aria-hidden="true">--}}
        {{--                                                <div class="modal-dialog modal-xl modal-dialog-centered">--}}
        {{--                                                    <div--}}
        {{--                                                        class="modal-content rounded-15px shadow">--}}
        {{--                                                        <div class="modal-header">--}}
        {{--                                                            <h5 class="modal-title" id="chartModalLabel-{{$k+1}}">--}}
        {{--                                                                Sensor Readings Chart--}}
        {{--                                                            </h5>--}}
        {{--                                                        </div>--}}
        {{--                                                        <div class="modal-body text-center">--}}
        {{--                                                            <canvas id="chartContainer-{{$k+1}}"--}}
        {{--                                                                    data-readings="{{$record['readings']}}"--}}
        {{--                                                                    class="align-middle"--}}
        {{--                                                                    style="max-height: 100% !important;"--}}
        {{--                                                                    data-sensor="{{$record["id"]}}"></canvas>--}}
        {{--                                                        </div>--}}
        {{--                                                        <div class="modal-footer">--}}
        {{--                                                            <button type="button" data-bs-dismiss="modal"--}}
        {{--                                                                    class="btn btn-secondary text-white">--}}
        {{--                                                                Close--}}
        {{--                                                            </button>--}}
        {{--                                                        </div>--}}
        {{--                                                    </div>--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}


        {{--                                            <button class="btn btn-danger btn-sm mx-1"--}}
        {{--                                                    data-bs-target="#deleteModal-{{$k+1}}"--}}
        {{--                                                    data-bs-toggle="modal">--}}
        {{--                                                <i class="fa fa-trash text-white"></i>--}}
        {{--                                            </button>--}}

        {{--                                            <div class="modal fade wow shakeX" id="deleteModal-{{$k+1}}" tabindex="-1"--}}
        {{--                                                 data-wow-iteration="1"--}}
        {{--                                                 aria-labelledby="deleteModalLabel-{{$k+1}}" aria-hidden="true">--}}
        {{--                                                <div class="modal-dialog modal-dialog-centered">--}}
        {{--                                                    <div--}}
        {{--                                                        class="modal-content rounded-15px shadow">--}}
        {{--                                                        <div class="modal-header">--}}
        {{--                                                            <h5 class="modal-title" id="deleteModalLabel-{{$k+1}}">--}}
        {{--                                                                Delete Selected Sensor Readings--}}
        {{--                                                            </h5>--}}
        {{--                                                        </div>--}}
        {{--                                                        <form action="/user/sensor-readings/{{$record['id']}}/clear"--}}
        {{--                                                              method="POST">--}}
        {{--                                                            <div class="modal-body">--}}
        {{--                                                                <p class="text-center wow pulse"--}}
        {{--                                                                   data-wow-iteration="10000">--}}
        {{--                                                                    <i class="fa fa-warning fa-5x text-danger"></i>--}}
        {{--                                                                </p>--}}
        {{--                                                                <p class="text-center text-wrap font-size-2rem">--}}
        {{--                                                                    Are you sure to delete the sensor readings?--}}
        {{--                                                                    This action is irreversible.--}}
        {{--                                                                </p>--}}
        {{--                                                                @csrf--}}
        {{--                                                            </div>--}}
        {{--                                                            <div class="modal-footer">--}}
        {{--                                                                <button type="button" data-bs-dismiss="modal"--}}
        {{--                                                                        class="btn btn-secondary text-white">--}}
        {{--                                                                    Close--}}
        {{--                                                                </button>--}}
        {{--                                                                <button type="submit" class="btn btn-danger text-white">--}}
        {{--                                                                    Delete--}}
        {{--                                                                </button>--}}
        {{--                                                            </div>--}}
        {{--                                                        </form>--}}
        {{--                                                    </div>--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}
        {{--                                        </td>--}}
        {{--                                    </tr>--}}
        {{--                                @endforeach--}}
        {{--                                </tbody>--}}
        {{--                            </table>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        @else--}}
        {{--            <div class="row mt-3">--}}
        {{--                <div class="col-12">--}}
        {{--                    <div class="card shadow alert alert-warning shadow-lg rounded-15px">--}}
        {{--                        <div class="card-body py-1">--}}
        {{--                            <p class="text-center font-size-18px m-0 p-0" id="writer">--}}
        {{--                                You don't have any sensors currently.--}}
        {{--                            </p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </div>
@endsection

@section('scripts')
    {{--    <script type="text/javascript" src="{{asset('assets/compiled/app.readings.js')}}"></script>--}}
@endsection
