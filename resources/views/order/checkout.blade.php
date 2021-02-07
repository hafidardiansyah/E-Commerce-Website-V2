@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6">

                <h5>Product Orders</h5>
                <hr>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Order</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ asset('storage/' . $product->image) }} Image" class="rounded" height="50">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->order }}</td>
                                <td>Rp {{ number_format($product->price * $product->order, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-center">
                                <strong>Total</strong>: Rp
                                {{ number_format($total, 2, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-md-6">

                <h5>Form Order</h5>
                <hr>

                <form action="{{ route('order') }}" method="POST">
                    @csrf
                    <h6>Select payment method</h6>

                    @foreach ($payments as $payment)
                        <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio"
                                value="{{ $payment->id }}" id="{{ $payment->id }}" name="payment_method">
                            <label class="form-check-label" for="{{ $payment->id }}">
                                {{ $payment->name }}
                            </label>
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                            placeholder="Please enter your address for delivery!"
                            autocomplete="off">{{ $user ? $user : '' }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" placeholder="Please enter your description for admin!"
                            autocomplete="off">{{ old('description') ?? $order->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Order</button>
                </form>

            </div>

        </div>

    </div>

@endsection
