@if(\Illuminate\Support\Facades\Session::has('success'))
    <div class="success" id="success-alert">
        <div class="alert alert-success alert-dismissible fade show shadow mb-0" role="alert">
            <p class="m-0">
                {{\Illuminate\Support\Facades\Session::get('success')}}
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
