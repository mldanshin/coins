<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ mix('style/admin.css') }}" rel="stylesheet">
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <title>{{ __("admin-layout.title") }}</title>
    </head>
    <body>
        @env("demo")
            @include("partials.demo-info")
        @endenv
        <header class="header">
            <nav class="nav-header">
                <a href="{{ route('index', ['lang' => App::currentLocale()]) }}"
                    title="{{ __('layout.logo.tooltip') }}"
                    tabindex="0"
                    >
                    <img class="icon-lg" src="{{ asset('img/layout/logo.svg') }}" alt="{{ __('layout.logo.image') }}">
                </a>
                <div class="flex-row gap-1">
                    <a class="button"
                        href="{{ route('download.document', ['type' => 'pdf']) }}"
                        title="{{ __('admin-layout.download.document-pdf.tooltip') }}"
                        tabindex="0"
                        >
                        <img class="icon-lg"
                            src="{{ asset('img/admin-layout/download-pdf.svg') }}"
                            alt="{{ __('admin-layout.download.document-pdf.image') }}">
                    </a>
                    <a class="button"
                        href="{{ route('download.pictures', ['type' => 'zip']) }}"
                        title="{{ __('admin-layout.download.picture.tooltip') }}"
                        tabindex="0"
                        >
                        <img class="icon-lg"
                            src="{{ asset('img/admin-layout/download-picture.svg') }}"
                            alt="{{ __('admin-layout.download.picture.image') }}">
                    </a>
                    <a class="button"
                        href="{{ route('download.database') }}"
                        title="{{ __('admin-layout.download.database.tooltip') }}"
                        tabindex="0"
                        >
                        <img class="icon-lg"
                            src="{{ asset('img/admin-layout/download-database.svg') }}"
                            alt="{{ __('admin-layout.download.database.image') }}">
                    </a>
                    @include("auth.control")
                </div>
            </nav>
        </header>
        <div class="content">
            @yield("content")
        </div>
        @include('danshin/comment::form')
        @include("partials.toast")
        @include("partials.spinner")
        @include("partials.messages-content")
        @include("partials.log")
        <footer class="footer">
            <a href="https://github.com/mldanshin/coins"
                target="_blank"
                title="{{ __('layout.github.tooltip') }}"
                > 
                <img class="icon-lg" src="{{ asset('img/layout/github.svg') }}" alt="github">
            </a>
            <div class="flex-column align-items-center">
                <div class="text-center">
                    <span>{{ DevelopmentHelper::getAuthorRoleComment() }}</span>
                    <span>{{ DevelopmentHelper::getAuthorName() }}</span>
                    <span>{{ DevelopmentHelper::getYear() }}</span>
                </div>
                <address>
                    <a href="mailto:{{ DevelopmentHelper::getAuthorEmail() }}" rel="nofollow">{{ DevelopmentHelper::getAuthorEmail() }}</a>
                </address>
            </div>
        </footer>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>