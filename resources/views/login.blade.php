@extends('layout.app')
@section('content')

<section>
        <div class="container-fluid">
            <div class="row align-items-xl-center align-items-stretch login-sector">
                <div class="col-md-6 nopadding">
                    <div class="login-left">
                        <div class="login-bg bg-overlay">
                            <div class="logo-after">
                                <div class="icon-img">
                                    <img src="{{ asset('frontend/assets/images/icon/graduation-hat.png') }}" alt="">
                                </div>
                                <div class="login__title text-capitalize">
                                    Coditor | Easy learning
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 nopadding">
                    <div class="inner-padding register-form">
                        <div class="col-lg-8 offset-lg-2">
                        @if(session()->has('error'))
                        <div class="alert alert-danger">
                        {{ session()->get('error') }}
                        </div>
                        @endif
                            <form id="login-form" name="login-form" class="nobottommargin" action="{{ route('login')}}" method="POST">
                                @csrf
                                <div class="heading">
                                    <h2 class="heading__title lh-1 mb-50 ">LOG-IN</h2>
                                </div><!-- /.heading -->
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero vitae, expedita ex
                                    repellat odit cum dolor dolorum, modi saepe dolorem temporibus velit omnis
                                    dignissimos pariatur.
                                </p>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" id="login-form-username" name="login-form-username" value="{{ old('email') }}"
                                        class="form-control" placeholder="Username" />

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="password" id="login-form-password" name="login-form-password" value=""
                                    class="form-control" placeholder="Password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-20">
                                    <input type="checkbox" name="" id=""> Remember Username
                                </div>
                                @if (Route::has('password.request'))
                                <div class="mb-20">
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                                @endif
                                
                                @csrf
                                <div class="mb-20">
                                    <button type="submit" class="btn btn__bordered btn__secondary btn__hover3" id="login-form-submit"
                                    name="login-form-submit" value="login">Login</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsections