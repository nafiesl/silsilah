<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('ext_css')
    <style>
    .page-header {
        margin-top: 0px;
    }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.partials.nav')

        <div class="container">
        {{-- {{ dump(get_class_methods(url())) }} --}}
        {{-- {{ url()->current().'?lang=en' }} --}}
        {{-- {{ dump(get_class_methods(Route::current())) }} --}}
        {{-- {{ dump(Route::current()->parameters()) }} --}}
        {{-- {{ dump(url(Route::getName(), ['query' => 'recent', 'order' => 'desc'])) }} --}}
        {{-- {{ dump(Route::current()->setParameter('lang', 'id')) }} --}}
        @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('ext_js')
    @yield('script')
</body>
</html>
