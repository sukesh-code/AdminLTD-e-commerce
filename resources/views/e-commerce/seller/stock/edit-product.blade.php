@extends('e-commerce.seller.master')

@php
    use App\Models\Category;
    $categories = Category::all();
@endphp

@section('edit-product-seller')
    <div class="container mt-4">

        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5><i class="fa fa-edit"></i> &nbsp; Edit Product </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('update.seller.product', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Product Name</label>
                            <input type="text" name="product_name"
                                value="{{ old('product_name', $product->product_name) }}" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Price</label>
                            <input type="number" name="price" value="{{ old('price', $product->product_price) }}"
                                class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Tax</label>
                            <input type="number" name="tax" value="{{ old('tax', $product->tax) }}"
                                class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control" accept="image/*"
                                onchange="showImage(event)">

                            <div class="mt-3">
                                <img id="previewImage" style="height:100px; display:none;">
                            </div>

                            <p>Current Image:</p>
                            @php
                                $imagePath = $product->product_image;
                            @endphp
                            <img src="{{ filter_var($imagePath, FILTER_VALIDATE_URL) ? $imagePath : asset($imagePath) }}"
                                alt="product-image" height="100px" width="100px">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Short Description</label>
                            <input type="text" name="short" value="{{ old('short', $product->small_description) }}"
                                class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="desc" class="form-control" rows="5">{{ old('desc', $product->description) }}</textarea>
                        </div>

                    </div>

                    <button class="btn btn-success">Update Product</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
    </script>
@endsection
