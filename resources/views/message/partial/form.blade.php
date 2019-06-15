@include("layouts.alert")
<div class="content msg-content-box">

    @php $content  = old('content') ?? "" @endphp
    @if($edit)
        @php $content  = decrypt($message->content) ?? "" @endphp
    @endif

    <div class="input-field">
        <span class="label-input">{{ __('Message') }}</span>
        <textarea class="input-box msg-content required" type="text" name="content" placeholder="{{ __('Message') }}" required>{{  $content }}</textarea>
    </div>
    @if(!$edit)

        @guest
        <input type="hidden" name="isPrivate" value="0" class="" />
        <input type="hidden" name="type" value="1" class="" />

    @else
    <div class="input-field">
        <span class="label-input">{{ __('Privacy') }}</span>
        <div class="readio-box">
            <label class="radiobox">
                <input type="radio" name="isPrivate" value="0" class="isPrivate" checked="checked"/>
                <span>{{__('Public')}}</span>
            </label>
            <label class="radiobox">
                <input type="radio" name="isPrivate" value="1" class="isPrivate" />
                <span>{{__('Private')}}</
            </label>
        </div>
    </div>
    @endguest

    <div class="input-field" style="display: none">
        <span class="label-input">{{ __('Type') }}</span>
        <input type="radio" name="type" value="1" class="form-control" checked="checked">{{__('Text')}}
        <input type="radio" name="type" value="2" class="form-control">{{__('Image')}}
        <input type="radio" name="type" value="3" class="form-control">{{__('Video')}}
    </div>

    <div class="input-field" style="display: none">
        <span class="label-input">{{ __('Duration') }}</span>
        <select name="duration" class="input-box" required >
            @php $options =  config("message.duration", []) @endphp
            @if(count($options))
                @foreach($options as $key => $value)
                    <option value="{{$key}}" @if($key == "1440") selected="selected" @endif> {{$value}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="input-field" id="password-div" style="display:none;">
        <span class="label-input">{{ __('Password') }}</span>
        <input type="password" name="password" id="password" class="input-box " placeholder="{{  __("Password") }}">
    </div>
    @endif
    <div class="input-field mb-0">
        <div class="pull-right">
            <button class="msg-submit-btn btn waves-effect" type="submit">
                {{ __('Submit') }}
            </button>
            <a class="msg-cancel-btn btn  waves-effect" href="{{route("frontend.messages.index")}}">
                {{ __('Cancel') }}
            </a>
        </div>
    </div>
</div>

