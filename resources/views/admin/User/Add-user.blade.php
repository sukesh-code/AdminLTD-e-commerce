@extends('admin.layout.master')

@section('dashboard')
    Category Magagement / <strong>Add Category</strong>
@endsection

@section('add-user-content')

<div class="container mt-4">

    <div class="card shadow border-0" style="width:83vw;  position: absolute; left: 1%; right: 1%;">
        <div class="card-body p-4">

            <h4 class="mb-4"><strong>Add User</strong></h4>

            <form action="{{ route('send.password.now') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Name <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter user name">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                    </div>
                </div>


                <div class="mb-4">
                    <label class="form-label">
                        Email <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter email address">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">

                    <button type="submit" class="btn btn-danger px-4">
                        Add User
                    </button>

                    <a href="{{ route('view-All-User.now') }}" class="btn btn-secondary px-4">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
