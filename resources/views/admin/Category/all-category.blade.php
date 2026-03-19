@extends('admin.layout.master')

@section('dashboard')
    Category Management / <strong>All Categories</strong>
@endsection


@section('user-content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <div class="container-fluid mt-4">

        <div class="card shadow border-0 rounded-4">

            <div class="card-header d-flex justify-content-between align-items-center"
                style="background:#2C3046; color:white;">

                <h5 class="mb-0">
                    <i class="fa-solid fa-layer-group"></i>
                    Category List
                </h5>

                <span class="badge bg-info fs-6">
                    Total : {{ count($allData) }}
                </span>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table id="userTable" class="table table-hover table-bordered align-middle text-center">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Parent Category</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($allData as $categorie)
                                <tr>

                                    <td>{{ $categorie->id }}</td>

                                    <td>
                                        <strong>{{ $categorie->title }}</strong>
                                    </td>

                                    <td>
                                        {{ $categorie->parent->title ?? '-' }}
                                    </td>

                                    <td>
                                        @if ($categorie->status == 'Inactive')
                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $categorie->created_at->format('d M Y') }}
                                    </td>


                                    <td>

                                        <div class="modal-footer justify-content-center gap-2">

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                                                Edit
                                            </button>

                                            <button type="submit" class="btn btn-danger">

                                                Delete
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function() {

            $('#userTable').DataTable({

                pageLength: 5,

                lengthMenu: [5, 10, 25, 50],

                responsive: true,

                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search categories..."
                }

            });

        });
    </script>
@endsection
