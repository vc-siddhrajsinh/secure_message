@extends('layouts.app')
@section('content')
<section class="page-section message-page">
        <div class="container-fluid ">
            <div class="row justify-content-center create-section">
                <div class="col-md-6 ">
                    <div class="msg-dashboard">
                        <span class="heading">{{ __('Edit Message') }}</span>
                        <div class="msg-form-box">
                    <form method="post" action="{{route("frontend.messages.update", $message->token)}}" name="msg-frm" id="messages_form"  >
                        @csrf
                        @method('put')
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
        })
    </script>
@endpush
