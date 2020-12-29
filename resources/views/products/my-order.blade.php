@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="container">

            <h3 class="text-dark">My Orders</h3>
            <hr>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        {{-- <th scope="col">Image</th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Delivery</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Payment Code</th>
                        <th scope="col">Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        @php
                        $total += $order->price * $order->order;
                        @endphp
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $order->name }}</td>
                            <td>Rp {{ number_format($order->price * $order->order, 2, ',', '.') }}</td>
                            <td>
                                @forelse ($delivery as $d)
                                    {{ $d->name . ' ' . $d->delivery_description }}
                                @empty
                                    Empty
                                @endforelse
                            </td>
                            <td>{{ $order->name }}</td>
                            <td>{{ 'SHOP' . $order->order_id }}</td>
                            <td>{{ $order->payment_status }}</td>
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
                </tbody>
            </table>

            {{ $orders->links() }}
        </div>

    </div>

@endsection
