@if (session()->has('success'))
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="alert alert-success">
                    <i class='bx bx-bell'></i> {{ session()->get('success') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="alert alert-danger">
                    <i class='bx bx-error'></i> {{ session()->get('error') }}
                </div>
            </div>
        </div>
    </div>
@endif
