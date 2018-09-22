@extends('admin.layouts.app-small')

@section('title', '| Reset password')

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">{{ __('Reset Password') }}</p>
        <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" placeholder="Repeat E-mail address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" placeholder="New password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <span class="help-block">{{ $errors->first('password') }}</span>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="password_confirmation" type="password" placeholder="Repeat new password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                                        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Reset Password') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
