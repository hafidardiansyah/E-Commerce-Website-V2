@extends('layouts.app', ['title' => 'Detail product'])

@section('content')

    <div class="container">

        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ asset($product->takeImage()) }}" class="card-img" height="100%"
                        alt="{{ $product->slug }} Image">
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

                        @if (Auth::check() && Auth::user()->role === 1)
                            <form action="{{ route('add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="slug" value="{{ $product->slug }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class='bx bxs-cart-add'></i>
                                    Add to cart
                                </button>
                            </form>
                        @endif

                        @if (Auth::check() && Auth::user()->role === 0)
                            <a href="/product/{{ $product->slug }}/edit" class="btn btn-warning">Edit</a>

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                Delete
                            </button>

                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">
                                                Are you sure you want to delete?
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h2>{{ $product->name }}</h2>
                                            <p class="text-secondary fs-6">
                                                Published on
                                                {{ $product->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/product/{{ $product->slug }}/delete" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
