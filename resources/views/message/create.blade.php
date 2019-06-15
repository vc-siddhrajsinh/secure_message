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
        })
    </script>
@endpush
