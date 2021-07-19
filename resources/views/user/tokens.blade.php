@extends('common.base')

@section('title')
    {{env('PROJECT_TITLE')}} | Tokens
@endsection

@section('body')
    @include('user.navbar')

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="p-5 rounded bg-white shadow shadow-lg rounded-15px">
                    <div class="float-end">
                        <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                Generate New Token
                            </button>
                        </form>
                    </div>
                    <h1>Tokens</h1>
                    <hr>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/user">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tokens</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if(count($data['tokens']) > 0)
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow shadow-lg rounded-15px">
                        <div class="card-body py-4">
                            <table class="table table-bordered table-hover table-striped" width="100%">
                                <thead>
                                <tr class="text-center">
                                    <th class="align-middle">#</th>
                                    <th class="align-middle">Token</th>
                                    <th class="align-middle">Is Used?</th>
                                    <th class="align-middle">Created At</th>
                                    <th data-orderable="false" class="align-middle">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data["tokens"] as $k => $record)
                                    <tr class="text-center">
                                        <td class="align-middle" style="white-space: nowrap;">{{$k+1}}</td>
                                        <td class="align-middle text-wrap">
                                            {{$record["token"]}}
                                        </td>
                                        <td class="align-middle text-wrap">
                                            {{$record["is_online"] ? "Yes": "No"}}
                                        </td>
                                        <td class="align-middle" style="white-space: nowrap;">
                                            {{$record["created_at"]}}
                                        </td>
                                        <td class="align-middle text-center" style="white-space: nowrap;">
                                            <button class="btn btn-danger btn-sm" data-bs-target="#deleteModal-{{$k+1}}"
                                                    data-bs-toggle="modal">
                                                <i class="fa fa-trash text-white"></i>
                                            </button>

                                            <div class="modal fade wow shakeX" id="deleteModal-{{$k+1}}" tabindex="-1"
                                                 data-wow-iteration="1"
                                                 aria-labelledby="deleteModalLabel-{{$k+1}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div
                                                        class="modal-content rounded-15px shadow">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel-{{$k+1}}">
                                                                Delete Selected Token
                                                            </h5>
                                                        </div>
                                                        <form action="/user/tokens/{{$record['id']}}/remove"
                                                              method="POST">
                                                            <div class="modal-body">
                                                                <p class="text-center wow pulse"
                                                                   data-wow-iteration="10000">
                                                                    <i class="fa fa-warning fa-5x text-danger"></i>
                                                                </p>
                                                                <p class="text-center text-wrap font-size-2rem">
                                                                    Are you sure to delete the selected token?
                                                                    This action is irreversible.
                                                                </p>
                                                                @csrf
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-bs-dismiss="modal"
                                                                        class="btn btn-secondary text-white">
                                                                    Close
                                                                </button>
                                                                <button type="submit" class="btn btn-danger text-white">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
                                You don't have any tokens currently.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
