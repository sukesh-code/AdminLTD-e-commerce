@extends('admin.layout.master')

@section('dashboard')
    User Magagement / <strong>All Users</strong>
@endsection

<?php
use App\Models\User;
$users = User::all();
?>

@section('user-content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container-fluid mt-4">

    <div class="card shadow border-0">

        <div class="card-header d-flex justify-content-between align-items-center"
            style="background:#2C3046; color:white;">

            <h5 class="mb-0">
                <i class="fa-solid fa-users"></i> Registered Users
            </h5>

            <span class="badge bg-info fs-6">
                Total : {{ count($users) }}
            </span>

        </div>

        <div class="card-body">

            <table id="userTable"
                class="table table-hover table-bordered align-middle text-center">

                <thead class="table-dark">
                    <tr>
                        <th width="60">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="100">Role</th>
                        <th width="120">Created</th>
                        <th width="120">Updated</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($users as $user)
                        <tr>

                            <td>{{ $user->id }}</td>

                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>
                                @if ($user->role == 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @else
                                    <span class="badge bg-warning text-dark">User</span>
                                @endif
                            </td>

                            <td>{{ $user->created_at->format('d M Y') }}</td>

                            <td>{{ $user->updated_at->format('d M Y') }}</td>

                            <td>

                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-sm btn-primary">

                                        <i class="fa-solid fa-pen-to-square"></i>

                                    </a>

                                    <button class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $user->id }}">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </div>

                                <!-- Delete Modal -->

                                <div class="modal fade"
                                    id="deleteModal{{ $user->id }}"
                                    tabindex="-1">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title text-danger">
                                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                                    Delete Confirmation
                                                </h5>

                                                <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal">
                                                </button>

                                            </div>

                                            <div class="modal-body text-center">

                                                Are you sure you want to delete
                                                <br>

                                                <strong class="text-danger">
                                                    {{ $user->name }}
                                                </strong> ?

                                            </div>

                                            <div class="modal-footer justify-content-center">

                                                <button type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal">

                                                    Cancel
                                                </button>

                                                <form action="{{ route('users.destroy', $user->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-danger">

                                                        Yes, Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

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
            searchPlaceholder: "Search users..."
        }

    });

});

</script>

@endsection
