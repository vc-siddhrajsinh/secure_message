@extends('layouts.loginMaster')

@section('content')
    <section class="page-section">
        <div class="login-section " style="background-image: url('/img/bg-01.jpg');">
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
                               class="required @error('password') is-invalid @enderror" placeholder="{{_("Password")}}">
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
                    @if (Route::has('register'))
                        <div class="clearfix"></div>
                        <div class="login-form-btn">
                            <div class="wrap-login-form-btn">
                                <div class="login-form-bgbtn reg-btn"></div>
                                <a class="login-btn" href="{{route('register')}}">
                                    {{ __('Register') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </section>
@endsection
@push("after-scripts")
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("#login-frm").validate();
        })
    </script>
@endpush
