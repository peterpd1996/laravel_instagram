@extends('layouts.app')
@section('content')
<div class="container">
      <div class="main-wrapper login-body">
            <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="login-left">
                            <div class="d-look">
                                <i class="fa fa-camera fa-3x" aria-hidden="true"></i>                           
                                <span>D'Look</span>
                            </div>
                        </div>
                        <div class="login-right">
                            <div class="login-right-wrap">
                               <h1>Log in</h1>
                                 <form method="POST" action="{{ route('login') }}">
                                      @csrf
                                    <div class="form-group">
                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                                    </div>
                                </form>
                                <!-- /Form -->
                                
                                <div class="text-center forgotpass"><a href="{{ route('password.request') }}">Forgot Password?</a></div>
                                <div class="login-or">
                                    <span class="or-line"></span>
                                    <span class="span-or">or</span>
                                </div>
                                  
                                <!-- Social Login -->
                                <div class="social-login">
                                    <span>Login with</span>
                                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="google"><i class="fa fa-google"></i></a>
                                </div>
                                <!-- /Social Login -->
                                
                                <div class="text-center dont-have">Don’t have an account? <a href="{{ route('register') }}">Register</a></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection
