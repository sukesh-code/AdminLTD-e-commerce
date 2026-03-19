@extends('admin.layout.master')

@section('dashboard')
    Category Management / <strong>Add Category</strong>
@endsection

@section('add-user-content')

<div class="container mt-4">

    <div class="card shadow border-0" style="width:81vw; position:absolute; left:1%; right:1%;">
        <div class="card-body p-4">

            <h4 class="mb-4"><strong>Add Category</strong></h4>

            <form action="{{ route('add.category.now') }}" method="POST">
                @csrf


                <div class="mb-3">
                    <label class="form-label">
                        Title <span class="text-danger">*</span>
                    </label>

                    <input type="text" name="title" class="form-control" placeholder="Enter category title">
                </div>


                <div class="mb-3">
                    <label class="form-label">
                        Parent Category
                    </label>

                    <select name="parent_id" class="form-control">

                        <option value="">Main Category</option>

                        @foreach($parents as $parent)

                            <option value="{{ $parent->id }}">
                                {{ $parent->title }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Status
                    </label>

                    <select name="status" class="form-control">

                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>

                    </select>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <button type="submit" class="btn btn-danger px-4">
                        Add Category
                    </button>

                    <a href="" class="btn btn-secondary px-4">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
