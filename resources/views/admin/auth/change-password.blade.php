@extends('admin.layout.master')

@section('dashboard')
Dashboard / <strong>Change Password</strong>
@endsection

@section('password-content')
    <div class="outer d-flex justify-content-center"
        style="background-color:#525873; width:100%; min-height:30vh; padding-top:40px; padding-bottom: 6vh;">

        <div class="container d-flex justify-content-center">

            <div class="card shadow" style="width:900vw; border:none;">

                <div class="card-body p-4" style="background-color:#2C3046; color:white; border-radius:6px;">

                    <h4 class=" mb-4"><strong>Change Password</strong></h4>

                    <form action="{{ route('change.password') }}" method="POST">
                        @csrf

                        <label for="Current_Password">Current Password <span style="color: red">*</span></label>

                        <div class="input-group mb-3" style="width:40vw;">
                            <input type="password" name="password_current" class="form-control">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                        </div>
                        <div class="text-danger">
                            @error('password_current')
                                {{ $message }}
                            @enderror
                        </div>

                        <label for="Current_Password">New Password <span style="color: red">*</span></label>
                        <div class="input-group mb-3" style="width:40vw;">
                            <input type="password" name="password_new" class="form-control">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                        </div>

                        <div class="text-danger">
                            @error('password_new')
                                {{ $message }}
                            @enderror
                        </div>

                        <label for="Current_Password">Confirm New Password <span style="color: red">*</span></label>
                        <div class="input-group mb-3" style="width:40vw;">
                            <input type="password" name="password_new_confirmation" class="form-control">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>

                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <button type="submit" class="btn btn-danger ">Change Password</button>
                            <a href="{{ route('LoginPage') }}" class="btn btn-secondary">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection
