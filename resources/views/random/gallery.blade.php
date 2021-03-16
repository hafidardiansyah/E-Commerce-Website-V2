@extends('layouts.app')

@section('content')

    <div class="container">
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
    </div>

@endsection
