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
                                            {!! $message->content !!}
                                            <h1>{{__('Message Link')}}</h1>
                                            {!! $message->content !!}
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

