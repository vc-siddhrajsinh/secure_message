@extends('layouts.app')
@section('content')
    <section class="page-section">
        @include('layouts.menu')
        <div class="login-section " style="background-image: url('/img/bg-01.jpg');">
            <div class="msg-dashboard">
                <span class="logo">{{ __('Create Message') }}</span>
                <div class="row">
                    <form method="post" action="{{route("frontend.messages.store")}}" name="msg-frm" id="messages_form"  >
                        @csrf
                        @include('message.partial.form')
                    </form>
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
