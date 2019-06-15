@extends('layouts.app')
@section('content')
    <section class="page-section home-page">
        <div class="container-fluid guest-user">
                @include("layouts.alert")
                <div class="guest-msg-btn">
                    <a class="create-btn" href="{{route("frontend.messages.create")}}" >{{__('Create Message')}}</a>
                </div>
                <div class="content msg-header">
                    <div class="msg-list">
                        <div class="msg-note-header">
                            @if($token)
                                <div class="msg-note-content">
                                    <h3> {{__('message:')}}</h3>
                                    {{ route('frontend.message.show',[$token]) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection

