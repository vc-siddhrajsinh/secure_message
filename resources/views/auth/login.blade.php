@extends('layouts.loginMaster')

@section('content')
    <section class="page-section login-page">
        <div class="login-section ">
            <div class="login-box">
                <form class="login-form" method="POST" action="{{ route('login') }}" id="login-frm">
                    @csrf
                    <span class="logo">{{ __('Login') }}</span>
                    @if(session('errors'))
                        <div class="input-wrap alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class="input-wrap username">
                        <span class="label-input">{{ __('Username') }}</span>
                        <input class="input-box" type="text" name="username" required
                               class="required @error('username') is-invalid @enderror" value="{{ old('username') }}"
                               placeholder="{{ __('Username') }}">
                        <span class="focus-input" data-symbol=""></span>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-wrap password">
                        <span class="label-input">{{ __('Password') }}</span>
                        <input class="input-box" type="password" name="password" required
                               class="required @error('password') is-invalid @enderror" placeholder="{{  __("Password") }}">
                        <span class="focus-input" data-symbol=""></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{--@if (Route::has('password.request'))
                        <div class="forgot-password ">
                            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        </div>
                    @endif--}}

                    <div class="login-form-btn">
                        <div class="wrap-login-form-btn">
                            <div class="login-form-bgbtn"></div>
                            <button class="login-btn" type="submit">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    @if (Route::has('register'))
                        <div class="register-link">
                                <a class="register-btn" href="{{route('register')}}">
                                    {{ __('Register') }}
                                </a>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="login-form-btn guest-user-btn">
                        <span class="or-line">OR</span>
                        <div class="wrap-login-form-btn">
                            <div class="login-form-bgbtn"></div>
                            <a class="login-btn" href="{{ route('frontend.guest.login') }}">
                                {{ __('Guest User') }}
                            </a>
                        </div>
                    </div>
                </form>
                
            </div>

            <div class="ocean">
                <div class="wave"></div>
                <div class="wave"></div>
            </div>
        </div>
    </section>
@endsection
@push("after-scripts")
    <script type="text/javascript">
            jQuery(document).ready(function () {
                $("#login-frm").validate({
                    rules: {
                        username: {
                            required: true,
                        },
                        password: {
                            required: true,
                        }
                    },errorPlacement: function(){
                        return false;
                    }

                });
            })
    </script>
@endpush
