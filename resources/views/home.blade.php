@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <h3 class="text-dark">Best Products</h3>
                <hr>
                <div class="row row-cols-1 row-cols-md-2" style="margin-top: -20px">
                    @forelse ($products as $product)
                        <div class="col-md-4 my-4">
                            <div class="card">
                                <a href="/detail/{{ $product->slug }}">
                                    <img src="{{ asset($product->takeImage()) }}" class="card-img-top img" height="250"
                                        alt="{{ $product->slug }} Image">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                    <a href="/detail/{{ $product->slug }}" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info my-3 ml-3">
                            Ther's no product.
                        </div>
                    @endforelse
                </div>
                {{ $products->links() }}
            </div>

            <div class="col-md-4">
                <h3 class="text-dark">Categories</h3>
                <hr>
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item{{ request()->is('products/' . $category->slug) ? ' active' : '' }}">
                            <a href="/products/{{ $category->slug }}"
                                class="text-decoration-none{{ request()->is('products/' . $category->slug) ? ' text-white' : ' text-dark' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                {{ $categories->links() }}
            </div>
        </div>
        <br><br>
            <h1 class="text-center">Gallery</h1>
            <hr>
      
            <div class="row">
              <a href="https://unsplash.it/1200/768.jpg?image=251" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                <img src="https://unsplash.it/600.jpg?image=251" class="img-fluid rounded">
              </a>
              <a href="https://unsplash.it/1200/768.jpg?image=252" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                <img src="https://unsplash.it/600.jpg?image=252" class="img-fluid rounded">
              </a>
              <a href="https://unsplash.it/1200/768.jpg?image=253" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                <img src="https://unsplash.it/600.jpg?image=253" class="img-fluid rounded">
              </a>
            </div>

        <br><br>
        <h1 class="text-center">About</h1>
        <hr>
        <p>ITShop adalah website jual beli online berkaitan tentang IT, yang dibuat oleh Hafid Ardiansyah. Menggunakan Framework Bootstrap 4.5 & Laravel 8.</p>
      

    </div>


@endsection
