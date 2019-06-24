@extends('layouts.app')
@section('content')
    <section class="page-section home-page">
        <div class="container-fluid ">
            <div class="row justify-content-center">
                @if($message != '')
                    @guest
                        @if(!empty($response) && isset($response->id))
                            @if($response->isPrivate == '1')
                                <div class="col-md-6 col-lg-4 noted-card" id="user_auth">
                                    <div class="card">
                                        <div class="card-header"><h3>Message </h3></div>
                                        <div class="card-body">
                                            <div class="card-form" id="msg-content">
                                                <form id="validate-pwd-frm" name="validate-pwd-frm" method="post">
                                                    <h3>This is private message.</h3>
                                                    <div class="input-field" id="password-div">
                                                        <input class="input-box" type="password" name="password"
                                                               id="user_password" placeholder="{{  __("Password") }}"
                                                               required/>
                                                    </div>
                                                    <div class="input-field mb-0">
                                                        <div class="text-right">
                                                            <button type="submit" class="btn waves-effect" name="submit"
                                                                    value="submit" id="m-id"
                                                                    data-id="{{$response->id}}"
                                                                    >
                                                                Submit
                                                            </button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @else
                                <div class="col-md-6 col-lg-4 noted-card" id="user_msg">
                                    <div class="card">
                                        <div class="card-header"><h3>Message </h3></div>
                                        <div class="card-body">
                                            {{ $message }}
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-md-6 col-lg-4 noted-card" id="user_msg">
                                <div class="card">
                                    <div class="card-header"><h3>Message </h3></div>
                                    <div class="card-body">
                                        {{ $message }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-6 col-lg-4 noted-card">
                            <div class="card">
                                <div class="card-header"><h3>Message </h3></div>
                                <div class="card-body">
                                    {{ $message }}
                                </div>
                            </div>
                        </div>
                    @endguest
                @else
                    <div class="no-data">
                        <div class="no-data-box">
                            {{ __('This message not longer available.') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        {{--@include('message.partial.create_button')--}}
    </section>
@endsection
@push("after-scripts")
    <script type="text/javascript">
        $("#validate-pwd-frm").submit(function (e) {
            e.preventDefault();
            var pwd = $("#user_password").val();
            if (pwd == "") {
                toasterMessage("please enter password.");
                return false;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: {'password': pwd, "id": $("#m-id").data('id')},
                url: '{{ route('frontend.message.password') }}',
                success: function (response) {
                    if (response.status == true) {
                        $("#msg-content").html("");
                        $("#msg-content").html(response.content);
                    }
                    toasterMessage(response.message);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });
    </script>
@endpush
