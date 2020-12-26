@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row my-4">
            <div class="col-md-6">
                <h5>Product Orders</h5>
                <hr>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
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
                                <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-center">
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
                <h6>Select payment method</h6>
                <div class="custom-control custom-radio custom-control-inline mb-3">
                    <input type="radio" id="indomaret" name="indomaret" class="custom-control-input">
                    <label class="custom-control-label" for="indomaret">Indomaret</label>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" placeholder="Please enter your description for admin!"
                        autocomplete="off"></textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

        </div>

    </div>

@endsection
