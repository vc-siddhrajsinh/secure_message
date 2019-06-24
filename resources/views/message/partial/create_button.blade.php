@if(\Route::has("frontend.messages.create"))
    <div class="create-btn-div">
        <a class="create-btn" href="{{route("frontend.messages.create")}}" class="btn btn-sm"> + </a>
    </div>
@endif
