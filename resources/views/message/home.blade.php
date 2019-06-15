@extends('layouts.app')
@section('content')
<section class="page-section home-page">
    <div class="container-fluid ">
        <div class="row justify-content-center">
            <div class="col-md-4 noted-card">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- <section class="page-section home-page">
        

        <div class="login-section " >
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
    </section> -->
@endsection

