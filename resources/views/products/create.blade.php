@extends('layouts.app', ['title' => 'Create product'])

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-6">
                <img src="https://dummyimage.com/200x200/f2f2f2/000333" alt="Default Image"
                    class="img-thumbnail img-preview">
            </div>
            <div class="col-md-6">
                <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('post') --}}
                    @include('products.partials.form-control', ['submit' => 'Create'])
                </form>
            </div>

        </div>

    </div>

@endsection
