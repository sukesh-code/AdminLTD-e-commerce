@extends('e-commerce.seller.master')

@php
    use App\Models\Product;
    use App\Models\Category;
    $products = Product::get();
    $category = Category::get();

@endphp

@section('product-content')
    <div class="container mt-4">

        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5><i class="fa fa-plus"></i> &nbsp; Add Product </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('seller.stock.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">-- Select Category --</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}"> {{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Tax</label>
                            <input type="text" name="tax" class="form-control">
                        </div>

                        <div class="col-md-12 mb-3" >
                            <label>Product Image</label>

                            <input type="file" name="product_image" class="form-control " accept="image/*"
                                onchange="showImage(event)">


                            <div class="mt-3">
                                <img id="previewImage" style="height:100px; display:none;">
                            </div>
                        </div>





                        <div class="col-md-12 mb-3">
                            <label>Short Description</label>
                            <input type="text" name="short" class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="desc" class="form-control"></textarea>
                        </div>

                    </div>

                    <button class="btn btn-success">Save</button>
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
