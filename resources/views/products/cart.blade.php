@extends('layouts.app', ['title' => 'Create product'])

@section('content')

    <div class="container">

        <h3 class="text-dark mt-4">My Orders</h3>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($products as $product)
                    @php
                    $total += $product->price;
                    @endphp

                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                            <img src="{{ asset($product->takeImage()) }}" alt="{{ asset($product->takeImage()) }} Image"
                                class="rounded" height="50">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class='bx bxs-trash'></i> Delete
                            </button>

                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                aria-hidden="true">
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
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                Ther's no product.
                            </div>
                        </div>
                    </div>
                @endforelse


                <tr>
                    <td colspan="4" class="text-center">
                        <strong>Total</strong>: Rp
                        {{ number_format($total, 2, ',', '.') }}
                    </td>
                    <td>
                        <a href="{{ route('order') }}" class="btn btn-sm btn-primary"><i class='bx bxs-cart'></i> Order</a>
                    </td>
                </tr>

            </tbody>
        </table>

        {{ $products->links() }}
    </div>

@endsection
