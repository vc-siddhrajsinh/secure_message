@extends('layouts.app')
@section('content')
    <section class="page-section message-page">
        <div class="container-fluid ">
            <div class="row justify-content-center create-section">
                <div class="col-md-6 ">
                    <div class="msg-dashboard">
                        <span class="heading">{{ __('Create Message') }}</span>
                        <div class="msg-form-box">
                            <form method="post" action="{{route("frontend.messages.store")}}" name="msg-frm" id="messages_form"  >
                                @csrf
                                @include('message.partial.form')
                            </form>
                        </div>
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
