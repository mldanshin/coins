<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link href="{{ mix('style/admin.css') }}" rel="stylesheet">
        <title>{{ __("auth.title") }}</title>
    </head>
    <body>
        <div class="auth-container">
            @env("demo")
                <div>
                    <div class="margin-y-1">
                        <span>{{ __("auth.identifier") }}:</span>
                        <span>user</span>
                    </div>
                    <div class="margin-y-1">
                        <span>{{ __("auth.password") }}:</span>
                        <span>demo</span>
                    </div>
                </div>
            @endenv
            @error('identifier')
                <div class="alert text-center">{{ $message }}</div>
            @enderror
            @error('throttle')
                <div class="alert text-center">{{ $message }}</div>
            @enderror
            <form class="auth-form" method="POST" action="{{ route("login.store") }}">
                @csrf
                <label for="identifier">
                    {{ __("auth.identifier") }}
                </label>
                <input id="identifier"
                    type="text"
                    name="identifier"
                    value="{{ old('identifier') }}"
                    required
                    autofocus
                    autocomplete="off">
                <label for="password">
                    {{ __("auth.password") }}
                </label>
                <input id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="off">
                <input type="submit" value="{{ __("auth.log_in") }}">
            </form>
        </div>
    </body>
</html>