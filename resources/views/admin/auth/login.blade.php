@extends('admin.layouts.app-small')

@section('title', '| Login')

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group has-feedback{{ $errors->has('login') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="login" id="login" placeholder="Enter login" value="{{ old('login') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('login'))
                    <span class="invalid-feedback" role="alert">
                        <span class="help-block">{{ $errors->first('login') }}</span>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' is-invalid' : '' }}">
                <input type="password" id="password" placeholder="Password" class="form-control" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>

        <a href="{{ route('password.request') }}">I forgot my password</a><br>
    </div>

@endsection
