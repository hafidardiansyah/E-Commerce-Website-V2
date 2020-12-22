<div class="mb-3">
    <label for="image">Image</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image"
            onchange="previewImg()">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <label class="custom-file-label" for="image">Choose image product!</label>
    </div>
</div>

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        placeholder="Please enter your name product!" autocomplete="off" value="{{ old('name') ?? $product->name }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
        placeholder="Please enter your price product!" autocomplete="off" value="{{ old('price') ?? $product->price }}">
    @error('price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
        placeholder="Please enter your description product!"
        autocomplete="off">{{ old('description') ?? $product->description }}</textarea>
    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button class="btn btn-primary" type="submit">{{ $submit ?? 'Update' }}</button>
