<div id="toast-container">
    @if(session("message"))
        <div class="toast">
            {{ session("message") }}
        </div>
    @endif
</div>