@extends('auth.layouts.credential-form')
@section('title')
    Login - Register
@endsection
@section('content')

<form method="POST" class="form-validate mb-4 bounceInDown animated" action="{{ route('users.process-change-password') }}" id="login-page">
    {{ csrf_field() }}
        <div class="form-group">
            <input id="login-username" type="text" name="username"
            autocomplete="off" data-msg="Please enter your username" class="input-material" value="{{ $user->username }}" readonly required>
            <label for="login-username" class="label-material">User Name</label>
        </div>
        <div class="form-group">
            <input id="login-oldPassword" type="password" name="oldPassword" required data-msg="Please enter your oldPassword" class="input-material">
            <label for="login-oldPassword" class="label-material">Password Lama</label>
        </div>

        <div class="form-group">
            <input id="login-newPassword" type="password" name="newPassword" required data-msg="Please enter your new Password" class="input-material">
            <label for="login-newPassword" class="label-material">Password Baru</label>
        </div>

        <div class="form-group">
            <input id="login-cNewPassword" type="password" name="cNewPassword" required data-msg="Re-Type Your New Password" class="input-material">
            <label for="login-cNewPassword" class="label-material">Re-Type New Password</label>
        </div>
        <button type="submit" class="btn btn-primary form-control">Login</button>
</form>
@endsection