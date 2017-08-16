@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        @include('users.partials.action-buttons', ['user' => $currentUser])
        {{ $currentUser->name }} <small>Profil</small>
    </h1>
    <div class="row">
        <div class="col-md-6">
            @include('users.partials.profile', ['user' => $currentUser])
            @include('users.partials.siblings', ['user' => $currentUser])
        </div>
        <div class="col-md-6">
            @include('users.partials.parent-spouse', ['user' => $currentUser])
            @include('users.partials.childs', ['user' => $currentUser])
        </div>
    </div>
@endsection
