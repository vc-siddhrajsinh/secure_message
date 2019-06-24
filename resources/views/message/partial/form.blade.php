@include("layouts.alert")
<div class="content msg-content-box">

    @php $content  = old('content') ?? "" @endphp
    @if($edit)
        @php $content  = decrypt($message->content) ?? "" @endphp
    @endif

    <div class="input-field">
        <span class="label-input">{{ __('Message') }}</span>
        <textarea class="input-box msg-content required" type="text" name="content"  placeholder="{{ __('Message') }}"
                  required>{{  $content }}</textarea>
    </div>
    @if(!$edit)

        @guest
            <input type="hidden" name="type" value="1" class=""/>
        @endguest
        <div class="input-field">
            <span class="label-checkbox">{{ __('Is Private') }}</span>
            <div class="check-box">
                <label class="checkbox">
                    <input type="checkbox" name="isPrivate" value="1" class="isPrivate"/>
                </label>
            </div>
        </div>
        <div class="input-field" style="display: none">
            <span class="label-input">{{ __('Type') }}</span>
            <input type="radio" name="type" value="1" class="form-control" checked="checked">{{__('Text')}}
            <input type="radio" name="type" value="2" class="form-control">{{__('Image')}}
            <input type="radio" name="type" value="3" class="form-control">{{__('Video')}}
        </div>

        <div class="input-field">
            <span class="label-input">{{ __('Duration') }}</span>
            <select name="duration" class="input-box" required>

                @php $options =  config("message.duration", []) @endphp
                @if(count($options))

                    @foreach($options as $key => $value)
                        <option value="{{$key}}" @guest @if($key == "5") selected="selected" @endif @else  @if($key == "1440") selected="selected" @endif @endguest> {{$value}}</option>
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
        <div class="text-right">
            <button class="msg-submit-btn btn waves-effect" type="submit">
                {{ __('Submit') }}
            </button>
            @auth
            <a class="msg-cancel-btn btn  waves-effect" href="{{route("frontend.messages.index")}}">
                {{ __('Cancel') }}
            </a>
            @endauth
        </div>
    </div>
</div>

