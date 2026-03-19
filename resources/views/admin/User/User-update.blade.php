@extends('admin.layout.master')

@section('dashboard')
User Magagement / <strong>Update User</strong>
@endsection


@section('update-user-content')


<div class="outer d-flex"
     style="background-color:#525873; width:100%; min-height:50vh; padding-top:40px; padding-bottom:6vh;">

    <div class="container d-flex justify-content-start">

        <div class="card shadow" style="width:60vw; border:none; position: absolute; left:1vw;">
            <div class="card-body p-4" style="background-color:#2C3046; color:white; border-radius:6px";>

                <h4 class=mb-4><strong>Update User</strong></h4>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')


                    <label>Name <span class="text-danger">*</span></label>
                    <div class="input-group mb-3" style="width:40vw">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $user->name }}">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                    </div>


                    <label>Email <span class="text-danger">*</span></label>
                    <div class="input-group mb-3"  style="width:40vw">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ $user->email }}">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                    </div>




                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="submit" class="btn btn-danger " style="width: 7vw">Update</button>
                        <a href="{{ route('view-All-User.now') }}" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
