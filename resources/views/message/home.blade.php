@extends('layouts.app')
@section('content')
<section class="page-section home-page">
    <div class="container-fluid ">
        <div class="row">
            @if(isset($messages) && count($messages))
                @foreach($messages as $message)
                <div class="col-md-4 noted-card">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{__("Message")}} </h3>
                            <div class="dropdown">
                                <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Copy Link</a>
                                    <a class="dropdown-item" href="{{route("frontend.messages.edit", $message->token)}}" class="btn btn-sm">{{__('Edit')}}</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="removeMessge(this)" data-id="{{$message->token}}"  class="btn btn-sm">{{__('Delete')}}</a>
                                </div>
                            </div>                            
                        </div>                    
                        <div class="card-body">
                            {!! decrypt($message->content) !!}
                        </div>
                    </div>
                </div>

                @endforeach
            @else
                <div class="no-data">
                    <div class="no-data-box">
                        
                        {{__("You didn't have any messages")}}
                    </div>
                 </div>
            @endif
            
        </div>
    </div>
    <div class="create-btn-div">
        <a class="create-btn" href="{{route("frontend.messages.create")}}" class="btn btn-sm">
            <!-- {{__('Create')}} -->
            +
        </a>
    </div>
</section>
@endsection
@push("after-scripts")
    <script type="text/javascript">
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
                        if (response.status == true) {
                            alert(response.message)
                            window.location.reload();
                        }  else {
                            alert(response.message)
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        }
    </script>
@endpush
