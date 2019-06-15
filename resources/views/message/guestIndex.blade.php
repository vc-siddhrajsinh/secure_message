@extends('layouts.app')
@section('content')

    <section class="page-section">
        @include('layouts.menu')

        <div class="login-section " >
            <div class="msg-dashboard">
                    <span class="logo">{{ __('Dashboard') }}</span>
                    @include("layouts.alert")
                <div class="row">
                    <a class="btn btn-primary pull-right" href="{{route("frontend.messages.create")}}" >{{__('Create Message')}}</a>
                    <div class="content msg-header">
                        <div class="msg-list">
                            <div class="msg-note-header">
                                <div class="msg-note-content">
                                    <h3> {{__('message:')}}</h3>
                                    {{ nl2br(route('frontend.messages.show',[$token])) }}
                                    <h1>{{__('Message Link')}}</h1>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

