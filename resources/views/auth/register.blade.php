@extends('layouts.loginMaster')

@section('content')
    <section class="page-section login-page">
        <div class="login-section ">
            <div class="login-box">
                    <form class="login-form"  method="POST" action="{{ route('register') }}" id="reg-frm">
                    @csrf
                    <span class="logo">{{ __('Register') }}</span>
                    @if(session('errors'))
                        <div class="alert alert-danger" role="alert">
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
                    <div class="input-wrap name">
                        <span class="label-input">{{ __('Name') }}</span>
                        <input class="input-box" type="text" name="name" required
                               class="required @error('name') is-invalid @enderror" value="{{ old('name') }}"
                               placeholder="{{ __('name') }}">
                        <span class="focus-input" data-symbol=""></span>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-wrap password">
                        <span class="label-input">{{ __('Password') }}</span>
                        <input class="input-box" type="password" name="password" required
                               class="required @error('password') is-invalid @enderror" id="password" placeholder="{{ __("Password") }}">
                        <span class="focus-input" data-symbol=""></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-wrap password password-confirm">
                        <span class="label-input">{{ __('Confirm Password') }}</span>
                        <input class="input-box" type="password"  id="password-confirm" name="password_confirmation" required
                               class="required" placeholder="{{ __('Confirm Password') }}">
                        <span class="focus-input" data-symbol=""></span>
                    </div>



                    <div class="login-form-btn">
                        <div class="wrap-login-form-btn">
                            <div class="login-form-bgbtn"></div>
                            <button class="login-btn" type="submit">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                        @if (Route::has('login'))
                        <div class="register-link">
                                <a class="register-btn" href="{{route('login')}}">
                                    {{ __('Login') }}
                                </a>
                        </div>
                        @endif
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
            $("#reg-frm").validate({
                rules: {
                    username: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 5,
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"

                    }
                },errorPlacement: function(){
                    return false;  // suppresses error message text
                }

            });
        })
    </script>
@endpush
