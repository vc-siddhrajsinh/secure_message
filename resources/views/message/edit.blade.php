@extends('layouts.app')
@section('content')
    <section class="page-section">
        @include('layouts.menu')
        <div class="login-section " style="background-image: url('/img/bg-01.jpg');">
            <div class="msg-dashboard">
                <span class="logo">{{ __('Edit Message') }}</span>
                <div class="row">
                    <form method="put" action="{{route("frontend.messages.update", $message->token)}}" name="msg-frm" id="messages_form"  >
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
        })
    </script>
@endpush
