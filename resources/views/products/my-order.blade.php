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
                            {{-- <td>
                                <img src="{{ asset($order->takeImage()) }}" alt="{{ asset($order->takeImage()) }} Image"
                                    class="rounded" height="50">
                            </td> --}}
                            <td>{{ $order->name }}</td>
                            <td>Rp {{ number_format($order->price * $order->order, 2, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    @empty
                        <?php echo "
                        <script>
                            alert('Empty order!');
                            document.location.href = 'products';

                        </script>
                        "; ?>
                    @endforelse
                </tbody>
            </table>

            {{ $orders->links() }}
        </div>

    </div>

@endsection
