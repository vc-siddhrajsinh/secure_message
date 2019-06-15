@extends('layouts.app')
@section('content')
    <section class="page-section">
        @include('layouts.menu')
        <div class="login-section " >
            <div class="msg-dashboard">
                    @include("layouts.alert")
                <div class="row">
                    <a class="btn btn-primary pull-right" href="{{route("frontend.messages.create")}}" >{{__('Create Message')}}</a><br/>
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
            </div>
        </div>
    </section>
@endsection

