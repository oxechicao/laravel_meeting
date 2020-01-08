<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1"
  >

  <!-- CSRF Token -->
  <meta
    name="csrf-token"
    content="{{ csrf_token() }}"
  >

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script
    src="{{ asset('js/app.js') }}"
    defer
  ></script>
  <script
    src="{{ asset('js/formHome.js') }}"
    defer
  ></script>

  <!-- Fonts -->
  <link
    rel="dns-prefetch"
    href="//fonts.gstatic.com"
  >
  <link
    rel="stylesheet"
    href="https://cdn.materialdesignicons.com/4.7.95/css/materialdesignicons.min.css"
  >
  <link
    href="https://fonts.googleapis.com/css?family=Nunito"
    rel="stylesheet"
  >

  <!-- Styles -->
  <link
    href="{{ asset('css/app.css') }}"
    rel="stylesheet"
  >
  <link
    href="{{ asset('css/tailwind.css') }}"
    rel="stylesheet"
  >
</head>
<body>
<div
  id="app"
  class="flex flex-col h-full min-h-screen"
>
  <div
    class="visible md:invisible w-full"
    style="position: fixed"
  >
    @include('layouts.menuHorizontal')
  </div>
  <div
    class="visible md:invisible h-full min-h-screen"
    style="position: fixed"
  >
    @include('layouts.menuVertical')
  </div>
  <div class="flex flex-col md:flex-row w-full min-h-screen h-full md:pl-32 pt-24 md:pt-0 bg-gray-200">
    @yield('content')
  </div>
</div>
</body>
</html>
