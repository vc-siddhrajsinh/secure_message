@extends('layouts.app')
@section('content')
    <section class="page-section message-page">
        <div class="container-fluid ">
            <div class="row justify-content-center create-section">
                <div class="col-md-6 ">
                    <div class="msg-dashboard">

                       @if(session()->has('link'))
                           <h1>HERE IS THE URL THAT WILL ALLOW YOU TO REVEAL YOUR MESSAGE</h1>
                            <h3 id="input_link_0">{{ session()->get('link') }}</h3>
                           <button class="btn btn-primary" onclick="copyLink('input_link_0')">Click to Copy</button>
                           {{ session()->forget('link') }}
                            <a class="btn btn-primary" href="{{ route('frontend.messages.create') }}">Create Message</a>
                       @else
                        <span class="heading">{{ __('Create Message') }}</span>
                        <div class="msg-form-box">
                            <form method="post" action="{{route("frontend.messages.store")}}" name="msg-frm" id="messages_form"  >
                                @csrf
                                @include('message.partial.form')
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push("after-scripts")
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("#messages_form").validate();

            jQuery(".isPrivate").click(function () {

               if (jQuery(this).val() != 1){
                   jQuery("#password-div").hide();
                   jQuery("#password").removeClass("required");
                   jQuery("#password").val("");
               } else {
                   jQuery("#password-div").show();
                   jQuery("#password").addClass("required");
               }

            });
        })

    </script>
@endpush
