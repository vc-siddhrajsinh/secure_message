@extends('layouts.app')
@section('content')
    <section class="page-section home-page">
        <div class="container-fluid ">
            <div class="row justify-content-center">
                @if($message != '')
                    <div class="col-md-6 noted-card">
                        <div class="card">
                            <div class="card-header">Message</div>
                            <div class="card-body">
                                {{ $message }}
                            </div>

                        </div>
                    </div>
                @else
                    <div class="no-data">
                        <div class="no-data-box">
                            This message not longer available
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
