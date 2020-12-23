@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="mt-4">Best Products</h3>

        <div class="row row-cols-1 row-cols-md-2">
            @forelse ($products as $product)
                <div class="col-md-3 my-4">
                    <div class="card">
                        <a href="/detail/{{ $product->slug }}">
                            <img src="{{ asset($product->takeImage()) }}" class="card-img-top img" height="250">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-6">
                    <div class="alert alert-info">
                        Ther's no post.
                    </div>
                </div>
            @endforelse
        </div>

        {{ $products->links() }}

    </div>

@endsection
