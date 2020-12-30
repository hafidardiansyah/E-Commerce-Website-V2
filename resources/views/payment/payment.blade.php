@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="{{ route('submit') }}" method="POST">
            @csrf
            @method('patch')
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">Please enter your code!</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                                name="code" autocomplete="off" value="{{ old('code') ?? $order->code }}"
                                style="text-transform:uppercase;">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10 mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection
