@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        @include('users.partials.action-buttons', ['user' => $user])
        {{ $user->name }} <small>@yield('subtitle')</small>
    </h1>
    @yield('user-content')
@endsection
