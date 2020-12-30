@extends('layouts.app')

@section('content')

    <div class="container">

        @foreach ($purchase as $p)

            <form action="/{{ $p->order_id }}/update" method="POST">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="delivery_description" class="col-sm-2 col-form-label">Delivery Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('delivery_description') is-invalid @enderror"
                                    id="delivery_description" name="delivery_description" autocomplete="off"
                                    value="{{ $p->delivery_description }}">
                                @error('delivery_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <br><br>
                            <div class="col-sm-2 col-form-label">
                                <label for="delivery_status" class="form-label">Delivery Status</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="delivery_status" id="delivery_status"
                                    class="form-control @error('delivery_status') is-invalid @enderror">
                                    @foreach ($delivery as $d)
                                        <option {{ $d->id == $p->delivery_status ? 'selected' : '' }} value="{{ $d->id }}">
                                            {{ $d->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('delivery_status')
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

        @endforeach
    </div>

@endsection
