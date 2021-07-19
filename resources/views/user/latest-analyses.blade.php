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
                    <a href="/user/symptoms/start"
                       class="hvr-pulse text-white float-end btn-sm btn btn-success mt-2 py-2">
                        Start New Symptoms Analysis
                    </a>
                    <h1>Latest Analyses</h1>
                    <hr>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/user">Home</a></li>
                            <li class="breadcrumb-item"><a href="/user/symptoms">Symptoms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Latest Analyses</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if(count($data['analyses']) > 0)
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow shadow-lg rounded-15px">
                        <div class="card-body py-4">
                            <p class="text-center font-size-20px m-0 p-0">
                                Your Latest Analysis
                            </p>
                            <hr width="20%" align="center" class="mx-auto">
                            <p class="text-center display-6 m-0 p-0" id="writer">
                                You may have
                                <b>{{end($data['analyses'])['disease']}}</b>
                            </p>
                            <hr width="20%" align="center" class="mx-auto">
                            <p class="text-center font-size-16px m-0 p-0">
                                Based on: {{end($data['analyses'])['symptoms']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow shadow-lg rounded-15px">
                        <div class="card-body py-4">
                            <table class="table table-bordered table-hover table-striped" width="100%">
                                <thead>
                                <tr class="text-center">
                                    <th class="align-middle">#</th>
                                    <th class="align-middle">Symptoms</th>
                                    <th class="align-middle">Disease</th>
                                    <th data-orderable="false" class="align-middle">Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data["analyses"] as $k => $record)
                                    <tr class="text-center">
                                        <td class="align-middle" style="white-space: nowrap;">{{$k+1}}</td>
                                        <td class="align-middle text-wrap">
                                            {{$record["symptoms"]}}
                                        </td>
                                        <td class="align-middle" style="white-space: nowrap;">
                                            {{$record["disease"]}}
                                        </td>
                                        <td class="align-middle" style="white-space: nowrap;">
                                            {{$record["created_at"]}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow alert alert-warning shadow-lg rounded-15px">
                        <div class="card-body py-1">
                            <p class="text-center font-size-18px m-0 p-0" id="writer">
                                You don't have any progressed analyses currently.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function () {
            @if(count($data['analyses']) > 0)
            window.SaySentence('Your latest analysis is that you may have' + "{{end($data['analyses'])['disease']}}");
            @endif
        });
    </script>
@endsection
