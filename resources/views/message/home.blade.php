@extends('layouts.app')
@section('content')
<section class="page-section home-page">
    <div class="container-fluid ">
        <div class="row">
            @if(isset($messages) && count($messages))
                @foreach($messages as $message)
                <div class="col-lg-4 col-md-6 noted-card">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{__("Message")}} </h3>
                            <div class="dropdown">
                                <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @php $element = 'input_link_'.$message->id @endphp
                                    <a class="dropdown-item" data-id="{{ 'input_link_'.$message->id }}" href="javascript:void(0)" onclick="copyLink('@php echo $element@endphp');"><i class="fa fa-clone" aria-hidden="true"></i>  Copy Link</a>
                                    <p style="display: none" id="input_link_{{ $message->id }}" >{{ route('frontend.message.show',[$message->token]) }}</p>
                                    <a class="dropdown-item" href="{{route("frontend.messages.edit", $message->token)}}" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  {{__('Edit')}}</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="removeMessge(this)" data-id="{{$message->token}}"  class="btn btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> {{__('Delete')}}</a>
                                </div>
                            </div>                            
                        </div>                    
                        <div class="card-body">
                            {!!  \Str::words(decrypt($message->content), 50) !!}
                
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
