@extends('layouts.app', ['title' => 'Detail product'])

@section('content')

    <div class="container">

        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ asset($product->takeImage()) }}" class="card-img" height="100%">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">
                            <small class="text-muted">Publish on
                                {{ $product->created_at->diffForHumans() }}
                            </small>
                        </p>
                        <a href="#" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
