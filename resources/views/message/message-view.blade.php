@extends('layouts.app')
@section('content')
    <section class="page-section home-page">
        <div class="container-fluid ">
            <div class="row justify-content-center">
                @if($message != '')
                    @guest
                        @if(!empty($response) && isset($response->id))
                            @if(isset($response->user_type) && $response->user_type != '0' && $response->isPrivate == '1')
                                <div class="col-md-4 noted-card" id="user_auth">
                                    <div class="card">
                                        <div class="card-header">Message</div>
                                        <div class="card-body">
                                            <h3 >This is private message. Please verify yourself.</h3>
                                            <input type="password" name="password" id="user_password" required/>
                                            <a class="btn btn-primary " data-id="{{$response->id}}"
                                                    onclick="validatePassword(this);"> Submit
                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 noted-card" style="display: none;" id="user_msg">
                                    <div class="card">
                                        <div class="card-header">Message</div>
                                        <div class="card-body">
                                            {{ $message }}
                                        </div>

                                    </div>
                                </div>
                            @else
                                <div class="col-md-4 noted-card"  id="user_msg">
                                    <div class="card">
                                        <div class="card-header">Message</div>
                                        <div class="card-body">
                                            {{ $message }}
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-md-4 noted-card"  id="user_msg">
                                <div class="card">
                                    <div class="card-header">Message</div>
                                    <div class="card-body">
                                        {{ $message }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-4 noted-card">
                            <div class="card">
                                <div class="card-header">Message</div>
                                <div class="card-body">
                                    {{ $message }}
                                </div>

                            </div>
                        </div>
                    @endguest
                @else
                    <div class="no-data">
                        <div class="no-data-box">
                            This message not longer available
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push("after-scripts")
    <script type="text/javascript">
        function validatePassword(ele) {
            var pwd = $("#user_password").val();
            if (pwd == "") {
                alert("please enter password");
                return false;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: {'password': pwd, "id": $(ele).data('id')},
                url: '{{ route('frontend.message.password') }}',
                success: function (response) {
                    if (response.status == true) {
                        $("#user_auth").hide();
                        $("#user_msg").show();
                    } else {
                        alert(response.message)
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    </script>
@endpush
