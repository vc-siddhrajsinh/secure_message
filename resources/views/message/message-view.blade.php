@extends('layouts.app')
@section('content')
    <section class="page-section home-page">
        <div class="container-fluid ">
            <div class="row justify-content-center">
                <div class="col-md-4 noted-card">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            {{ $message ?? 'This message not longer available' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
