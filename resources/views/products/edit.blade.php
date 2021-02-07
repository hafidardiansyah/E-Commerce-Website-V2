@extends('layouts.app', ['title' => 'Create product'])

@section('content')

    <div class="container">
        <h3>Edit Product</h3> 
        <hr>
        <div class="row">

            <div class="col-md-6">
                <h6>View image</h6>
                <img src="{{ asset($product->takeImage()) }}" alt="{{ $product->slug }} Image"
                    class="img-thumbnail img-preview">
            </div>
            <div class="col-md-6">
                <form action="/product/{{ $product->slug }}/update" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    @include('products.partials.form-control')
                </form>
            </div>

        </div>

    </div>

@endsection
