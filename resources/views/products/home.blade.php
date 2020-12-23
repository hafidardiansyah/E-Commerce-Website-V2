@extends('layouts.app')

@section('content')

    <div class="container">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($carouselProducts as $product)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $product->id }}"
                        class="{{ $product->id == 2 ? 'active' : '' }} bg-primary"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($carouselProducts as $product)
                    <div class="carousel-item {{ $product->id == 2 ? 'active' : '' }}">
                        <img src="{{ asset($product->takeImage()) }}" class="d-block w-100" height="300">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

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
                            <a href="/detail/{{ $product->slug }}" class="btn btn-primary">Detail</a>
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

        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div> --}}

        {{ $products->links() }}

    </div>

@endsection
