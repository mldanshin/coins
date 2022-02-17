@guest
    <a href="{{ route('login', ['lang' => App::currentLocale()]) }}" title="{{ __('auth.log_in') }}" tabindex="0">
        <img class="icon-lg"
            src="{{ asset('img/auth/login.svg') }}"
            alt="login">
    </a>
@endguest
@auth
    <form method="POST" action="{{ route('login.destroy') }}" tabindex="0">
        @csrf
        <input class="icon-lg"
            type="image" 
            src="{{ asset('img/auth/logout.svg') }}"
            alt="logout"
            title="{{ __('auth.log_out') }}">
    </form>
@endauth