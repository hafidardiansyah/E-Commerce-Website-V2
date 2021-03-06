@extends('layouts.app', ['title' => 'Create product'])

@section('content')
    <div class="container">
        <h3 class="text-dark">My Cart</h3>
        <hr>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Order</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    @php
                    $total += $product->price * $product->order;
                    @endphp
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                            <img src="{{ asset($product->takeImage()) }}" alt="{{ asset($product->takeImage()) }} Image"
                                class="rounded" height="50">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price * $product->order, 2, ',', '.') }}</td>
                        <td>
                            <div class="clearfix">
                                <input type="number" name="order" class="form-control form-control-sm"
                                    value="{{ $product->order }}" disabled>
                                <form action="/cart/{{ $product->cart_id }}/minus" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger mt-2"><i class='bx bxs-minus-circle'></i>
                                        Minus
                                    </button>
                                </form>
                                <form action="/cart/{{ $product->cart_id }}/plus" method="POST" class="float-left mr-2 mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success"><i class='bx bxs-plus-circle'></i>
                                        Plus
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $product->cart_id }}"><i class='bx bxs-trash'></i>
                                Delete
                            </button>

                            <div class="modal fade" id="deleteModal{{ $product->cart_id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete?
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h2>{{ $product->name }}</h2>
                                            <p class="text-secondary fs-6">
                                                Price Rp {{ number_format($product->price, 2, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/cart/{{ $product->cart_id }}/delete" method="POST">
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
                        </td>
                    </tr>
                @empty
                    <div class="row">
                        <div class="container">
                            <div class="alert alert-info">
                                Ther's no product.
                            </div>
                        </div>
                    </div>
                @endforelse
                <tr>
                    <td colspan="5" class="text-center">
                        <strong>Total</strong>: Rp
                        {{ number_format($total, 2, ',', '.') }}
                    </td>
                    <td>
                        <a href="{{ route('checkout') }}" class="btn btn-sm btn-primary">
                            Checkout
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        {{ $products->links() }}
    </div>

@endsection
