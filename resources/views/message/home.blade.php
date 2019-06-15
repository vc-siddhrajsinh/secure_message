@extends('layouts.app')
@section('content')

    <section class="page-section">
        @include('layouts.menu')

        <div class="login-section " style="background-image: url('/img/bg-01.jpg');">
            <div class="msg-dashboard">
                    <span class="logo">{{ __('Dashboard') }}</span>
                    @include("layouts.alert")
                <div class="row">
                    <a class="btn btn-primary pull-right" href="{{route("frontend.messages.create")}}" >{{__('Create Message')}}</a>
                    <div class="content msg-header">
                        <div class="msg-list">
                            @if(isset($messages) && count($messages))
                                @foreach($messages as $message)
                                    <div class="msg-note-header">
                                        <div class="msg-note-content">
                                            <h3> {{__('message:')}}</h3>
                                            {!! decrypt($message->content) !!}
                                            <h1>{{__('Message Link')}}</h1>
                                            {!! $message->token !!}
                                            <a href="{{route("frontend.messages.edit", $message->token)}}" class="btn btn-sm">Edit </a>
                                            <a href="javascript:void(0)" onclick="removeMessge(this)" data-id="{{$message->token}}"  class="btn btn-sm">delete </a>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="msg-note-header">
                                    <span>
                                        {{__("You didn't have any messages")}}
                                    </span>
                                </div>
                            @endif
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

        })

        function removeMessge(ele) {
            if(confirm("Are you sure to delete this message?")){
                var id = jQuery(ele).data('id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'delete',
                    url: '{{ url('messages') }}'+'/'+id,
                    success: function (response) {
                        if (response.status == true)
                            window.location.reload();
                        else
                            console.log(response.message);
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        }
    </script>
@endpush
