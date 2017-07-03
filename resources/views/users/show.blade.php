@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        <div class="pull-right">
            @can ('edit', $currentUser)
            {{ link_to_route('users.edit', 'Edit Data', [$currentUser->id], ['class' => 'btn btn-warning']) }}
            @endcan
            {{ link_to_route('users.chart', 'Lihat Bagan Keluarga', [$currentUser->id], ['class' => 'btn btn-default']) }}
            {{ link_to_route('users.tree', 'Lihat Pohon Keluarga', [$currentUser->id], ['class' => 'btn btn-default']) }}
        </div>
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
