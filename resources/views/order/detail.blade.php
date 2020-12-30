@extends('layouts.app')

@section('content')

    <div class="container">

        <a href="{{ route('my-order') }}" class="btn btn-primary mb-2">Back</a>
        <table class="table table-bordered table-hover">
            <tr>
                <th>Delivery Status</th>
                <th>Delivery Description</th>
                <th>Description</th>
            </tr>
            @forelse ($results as $result)
                <tr>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->delivery_description }}</td>
                    <td>{{ $result->description }}</td>
                </tr>
            @empty
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            Empty
                        </div>
                    </div>
                </div>
            @endforelse
        </table>

    </div>

@endsection
