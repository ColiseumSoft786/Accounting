@extends('layouts.account')

@section('content')
    <div class="horizontal-layout horizontal-menu 1-column" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="col-md-4 col-10 box-shadow-2 p-0">
                                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                    <div class="card-header border-0">
                                        <div class="card-title text-center">
                                            <img src="{{ asset('account') }}/images/logo/stack-logo-dark.png" alt="branding logo">
                                        </div>
                                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Easily Using</span></h6>
                                    </div>
                                    <div class="card-content">
                                        <div class="text-center">
                                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="fa fa-facebook"></span></a>
                                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="fa fa-twitter"></span></a>
                                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span class="fa fa-linkedin font-medium-4"></span></a>
                                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github"><span class="fa fa-github font-medium-4"></span></a>
                                        </div>
                                        <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>OR Using Account Details</span></p>
                                        <div class="card-body">
                                            <form method="POST" class="form-horizontal" action="{{ route('login') }}" >
                                                @csrf
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="email"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('email') }}" autofocus id="email" placeholder="Email Address" required name="email">
                                                    <div class="form-control-position">
                                                        <i class="ft-user"></i>
                                                    </div>
                                                </fieldset>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                @endif
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="Enter Password" required name="password">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-key"></i>
                                                    </div>

                                                </fieldset>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-12 text-center text-sm-left">
                                                        <fieldset>
                                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="remember" class="chk-remember">
                                                            <label for="remember-me"> Remember Me</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a></div>
                                                </div>
                                                <button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Login</button>
                                            </form>
                                        </div>
                                        <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>New to Stack ?</span></p>
                                        <div class="card-body">
                                            <a href="" class="btn btn-outline-danger btn-block"><i class="ft-user"></i> Register</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>








    {{--<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection
