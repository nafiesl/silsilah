@extends('layouts.user-profile-wide')

@section('subtitle', trans('app.family_tree'))

@section('user-content')
    @include('users.partials.family-tree-buttons', ['user' => $user])
    <div style="margin-top: 20px; clear: both;">
        @yield('family-tree-content')
    </div>
@endsection
