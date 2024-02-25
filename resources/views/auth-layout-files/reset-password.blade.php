@extends('auth-layout-files.master')

@section('title')
    Reset Password
@endsection
@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Air Travels</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Reset Your Password</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <div class="input-group my-2">
                    <!-- Email Address -->
                    <input type="email" class="form-control" name="email" value="{{ old('email',$request->email) }}"
                        placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @if ($errors->has('email'))
                    <code>{{ $errors->first('email') }}</code>
                @endif
                <!-- Password -->
                <div class="input-group my-2">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @if ($errors->has('password'))
                    <code>{{ $errors->first('password') }}</code>
                @endif
                <div class="input-group my-2">
                    <input type="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @if ($errors->has('password_confirmation'))
                    <code>{{ $errors->first('password_confirmation') }}</code>
                @endif
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form
        </div>
        <!-- /.login-card-body -->
    </div>
</div>


@endsection
