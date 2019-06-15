@include("layouts.alert")
<div class="content msg-content">

    @php $content  = old('content') ?? "" @endphp
    @if($edit)
        @php $content  = decrypt($message->content) ?? "" @endphp
    @endif

    <div class="form-group row">
        <span class="label-input">{{ __('Message') }}</span>
        <textarea class="input-box msg-content required form-control" type="text" name="content"
                  placeholder="{{ __('content') }}">{{$content}}</textarea>
    </div>
    @if(!$edit)

        @guest

            <input type="radio" style="display: none" name="isPrivate" value="0" class="isPrivate form-control "
                   checked="checked"
            >

        @else
            <div class="form-group row">
                <span class="label-input">{{ __('Privacy') }}</span>
                <input type="radio" name="isPrivate" value="0" class="isPrivate form-control " checked="checked"
                >{{__('Public')}}
                <input type="radio" name="isPrivate" value="1" class="isPrivate form-control">{{__('Private')}}
            </div>
        @endguest

        <div class="form-group row" style="display: none">
            <span class="label-input">{{ __('Type') }}</span>
            <input type="radio" name="type" value="1" class="form-control" checked="checked">{{__('Text')}}
            <input type="radio" name="type" value="2" class="form-control">{{__('Image')}}
            <input type="radio" name="type" value="3" class="form-control">{{__('Video')}}
        </div>

        <div class="form-group row">
            <span class="label-input">{{ __('Duration') }}</span>
            <select name="duration" class="form-control" required>
                @php $options =  config("message.duration", []) @endphp
                @if(count($options))
                    @foreach($options as $key => $value)

                        <option value="{{$key}}"> {{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group row" id="password-div" style="display: none">
            <span class="label-input">{{ __('Password') }}</span>
            <input type="password" name="password" id="password" class="form-control " minlength="6">
        </div>
    @endif
    <div class="form-group row mb-0">
        <button class="msg-submit-btn" type="submit">
            {{ __('Submit') }}
        </button>
        <a class="msg-cancel-btn btn btn-danger" href="{{route("frontend.messages.index")}}">
            {{ __('Cancel') }}
        </a>
    </div>
</div>

