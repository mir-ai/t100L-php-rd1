<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head {!! $ogp_title ?? ''
    ? 'prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#"'
    : '' !!}>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="{{ config('_env.FAVICON_FORCE_URL') }}">

  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Title --}}
  <title>
    {{ $page_title ?? config('_env.APP_TITLE_JP') }}
  </title>

  {{-- スクリプト --}}
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  {{-- スクリプト --}}
  @yield('js')
  @stack('scripts')
  @yield('css')
  @yield('meta')

  {{-- OGP--}}
  @if ($ogp_title ?? '')
    <meta property="og:url" content="{{ $ogp_url ?? '' }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $ogp_title ?? '' }}" />
    <meta property="og:description" content="{{ $ogp_description ?? '' }}" />
    <meta property="og:site_name" content="{{ $ogp_site_name ?? '' }}" />
    <meta property="og:image" content="{{ $ogp_image ?? '' }}" />
  @endif

</head>

<body>

  {{-- Original guest --}}
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img alt="{{ config('_env.APP_NAME_JP') }}" src="{{ config('_env.HEAD_LOGO_IMG_URL') }}" height="23" width="95" class="d-inline-block align-text-top">
          {{ config('_env.APP_NAME_JP') }}
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto">
          </ul>

          <!-- Right Side Of Navbar -->
          @php
            $routeName = request()->route()->getName();
          @endphp

          <ul class="navbar-nav ms-auto">
            @auth
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {!! Auth::user()->name !!}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                  <x-dropdown.dropdown />

                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      <div class="container{{ isset($container_fluid) ? '-fluid' : '' }}">
        {{-- フラッシュメッセージ --}}
        <x-flash.message />
        <x-flash.warning />

        {{-- タイトル --}}
        @if (!empty($title))
          <div class="row">
            <div class="col-sm-8">
              <h2>{{ $title }}</h2>
            </div>
            <div class="col-sm-4">
              @yield('rightnav')
            </div>
          </div>
        @endif

        @yield('content')

        {{-- フッター --}}
        <p class="text-center mt-5">
          © {{ now()->format('Y') }} {{ config('_env.FOOTER_CREDIT') }}

          <x-dev.dump-route />
        </p>
      </div>

    </main>
  </div>

  <div class="d-none">
    @stack('hidden-div')
  </div>

  @livewireScripts

  @stack('js-bottom')
</body>

</html>
