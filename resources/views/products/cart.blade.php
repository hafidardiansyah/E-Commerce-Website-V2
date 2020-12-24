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
                @php
                $i = 1;
                @endphp

                @foreach ($products as $product)

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
                            <a href="#" class="btn btn-sm btn-danger"><i class='bx bxs-trash-alt'></i> Delete</a>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4" class="text-center">
                        <strong>Total</strong>: Rp {{ number_format($total, 2, ',', '.') }}
                    </td>
                    <td><a href="#" class="btn btn-sm btn-primary"><i class='bx bx-money'></i> Buy</a></td>
                </tr>

            </tbody>
        </table>

    </div>

@endsection
