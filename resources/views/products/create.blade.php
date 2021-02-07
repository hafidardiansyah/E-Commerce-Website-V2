@extends('layouts.app', ['title' => 'Create product'])

@section('content')

    <div class="container">
        <h3 class="text-dark">Create Product</h3>
        <hr>
        <div class="row">

            <div class="col-md-6">
                <h6>View image</h6>
                <img src="https://dummyimage.com/200x200/f2f2f2/000333" alt="Default Image"
                    class="img-thumbnail img-preview">
            </div>
            <div class="col-md-6">
                <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('products.partials.form-control', ['submit' => 'Create'])
                </form>
            </div>

        </div>

    </div>

@endsection
