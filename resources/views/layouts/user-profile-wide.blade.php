@extends('layouts.app')

@section('content')
</div>
<div class="container-fluid">
    <h2 class="page-header">
        @include('users.partials.action-buttons', ['user' => $user])
        {{ $user->name }} <small>@yield('subtitle')</small>
    </h2>
    @yield('user-content')
@endsection
