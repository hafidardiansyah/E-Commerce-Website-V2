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
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Payment Code</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        @php
                        $total += $order->price * $order->order;
                        @endphp
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td><a href="/detail/{{ $order->slug }}"
                                    class="text-decoration-none text-dark">{{ $order->product_name }} </a></td>
                            <td>Rp {{ number_format($order->price * $order->order, 2, ',', '.') }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ 'SHOP' . $order->order_id }}</td>
                            <td>
                                @if ($order->payment_status != 0)
                                    <p class="text-success">Already paid</p>
                                @else
                                    <p class="text-danger">Unpaid</p>
                                @endif
                            </td>
                            <td>
                                <a href="/order/{{ $order->order_id }}/detail" class="btn btn-sm btn-info text-white">Detail</a>
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
                </tbody>
            </table>

            {{ $orders->links() }}
        </div>

    </div>

@endsection
